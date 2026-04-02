<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StaffController extends Controller
{
    //Home staff
    public function home() {
        $userId = Auth::id();
        // Total idea
        $totalIdeas = Idea::where('userId', $userId)->count();

        // Total vote
        $totalMyVotes = Reaction::where('userId', $userId)->count();

        // Total interaction
        $totalSystemIdeas = Idea::count();

        $engagementPercentage = 0;
        if ($totalSystemIdeas > 0) {
            // Calculate the percentage and use the min() function to ensure it is a maximum of 100%
            $engagementPercentage = min(100, round(($totalMyVotes / $totalSystemIdeas) * 100));
        }

        // Display to the staff home screen
        return view('staff.home', compact('totalIdeas', 'totalMyVotes', 'engagementPercentage'));
    }

    //List of my submission
    public function mySubmissions() {
        $categories = \App\Models\Category::all();
        $myIdeas = Idea::where('userId', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('staff.mySubmissions', compact('categories', 'myIdeas'));
    }

    //Check & setup auth question
    public function authSetup(){
        $user = Auth::user();

        // Check active_security_question -> return home
        if ($user && !empty($user->active_security_question)) {
            return redirect()->route('staff.home');
        }
        return view('staff.authSetup');
    }

    //Auth question
    public function authQuestionSetup(Request $request){
        $request->validate([
            'security_question' => ['required', 'in:favorite_animal,favorite_color,child_birth_year'],
            'answer'            => ['required'],
            'term'              => ['required']
        ]);

        $user = Auth::user();

        if ($user) {

            $user->favorite_animal = null;
            $user->favorite_color = null;
            $user->child_birth_year = null;

            $user->{$request->security_question} = $request->answer;
            $user->active_security_question      = $request->security_question;
            $user->save();

            return redirect()->route('staff.home')->with('success', 'Security question set up successfully!');
        }

        return redirect()->route('loginPage');
    }

    // New idea
    public function storeIdea(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'document' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $idea = new Idea();
        $idea->title = $request->title;
        $idea->description = $request->description;
        $idea->categoryId = $request->category_id;
        $idea->userId = Auth::id();

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('ideas', 'public');
            $idea->filePath = $path;
        }

        $idea->save();

        return redirect()->route('staff.mySubmissions')->with('success', 'Idea submitted successfully!');
    }

    // Sort of Social Media
    public function socialMedia(Request $request)
    {
        $ideas = \App\Models\Idea::with('user')
            ->withCount([
                'reactions as upvotes' => function ($query) { $query->where('is_upvote', true); },
                'reactions as downvotes' => function ($query) { $query->where('is_upvote', false); }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($sort === 'popular') {
            $query->orderByRaw('(
                (SELECT COUNT(*) FROM reactions WHERE reactions."ideaId" = ideas."ideaId" AND is_upvote = true) -
                (SELECT COUNT(*) FROM reactions WHERE reactions."ideaId" = ideas."ideaId" AND is_upvote = false)
            ) DESC');
        } elseif ($sort === 'viewed') {
            $query->orderBy('views', 'desc');
        } elseif ($sort === 'comments') {
            //  Prioritize the newest comment -> create time of the idea
            $query->orderByRaw('GREATEST(
                COALESCE((SELECT MAX(created_at) FROM comments WHERE comments."ideaId" = ideas."ideaId"), ideas.created_at),
                ideas.created_at
            ) DESC');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $ideas = $query->paginate(5)->withQueryString();
        $myReactions = Reaction::where('userId', Auth::id())->pluck('is_upvote', 'ideaId')->toArray();

        return view('staff.socialMedia', compact('ideas', 'myReactions', 'sort'));
    }

    //Save comment
    public function storeComment(Request $request, $ideaId)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        Comment::create([
            'ideaId' => $ideaId,
            'userId' => Auth::id(),
            'content' => (string) $request->input('content'),
            'is_anonymous' => $request->has('is_anonymous')
        ]);

        return redirect()->back()->with('success', 'Your comment has been posted!');
    }

    //Download idea
    public function downloadIdea($id)
    {
        $idea = \App\Models\Idea::findOrFail($id);
        $path = storage_path('app/public/' . $idea->filePath);
        return response()->download($path);
    }

        //like/dislike
    public function react(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);
        $deadline = Carbon::parse($idea->created_at)->endOfWeek();

        if (now()->greaterThan($deadline)) {
            return response()->json(['message' => 'The voting period for this post ended last Sunday!'], 403);
        }

        $isUpvote = $request->action === 'upvote';
        $userId = Auth::id();

        $reaction = \App\Models\Reaction::where('ideaId', $id)->where('userId', $userId)->first();

        if ($reaction) {
            if ($reaction->is_upvote == $isUpvote) {
                $reaction->delete();
            } else {
                $reaction->update(['is_upvote' => $isUpvote]);
            }
        } else {
            \App\Models\Reaction::create([
                'ideaId' => $id,
                'userId' => $userId,
                'is_upvote' => $isUpvote
            ]);
        }

        $upvotes = \App\Models\Reaction::where('ideaId', $id)->where('is_upvote', true)->count();
        $downvotes = \App\Models\Reaction::where('ideaId', $id)->where('is_upvote', false)->count();

        return response()->json(['upvotes' => $upvotes, 'downvotes' => $downvotes]);
    }
    // Edit idea
    public function editIdea($id)
    {
        $idea = Idea::findOrFail($id);
        // Check Author, if not author, Can't be edit ideas.
        if ($idea->userId !== Auth::id()) {
            abort(403, 'You have no permission to edit other people ideas!');
        }

        // Check Time if close vote, can't edit anymore.
        $deadline = Carbon::parse($idea->created_at)->endOfWeek();
        if (now()->greaterThan($deadline)) {
            return redirect()->route('staff.mySubmissions')->with('error', 'This post is now closed for voting. You can no longer edit the content!');
        }

        $categories = \App\Models\Category::all();

        return view('staff.editIdea', compact('idea', 'categories'));
    }

    // Update idea
    public function updateIdea(Request $request, $id)
    {
        $idea = Idea::findOrFail($id);

        if ($idea->userId !== Auth::id()) {
            abort(403, 'You have no permission to edit other people ideas!');
        }

        $deadline = Carbon::parse($idea->created_at)->endOfWeek();
        if (now()->greaterThan($deadline)) {
            return redirect()->route('staff.mySubmissions')->with('error', 'Action rejected: Post has been locked!');
        }

        // Validate data
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'document' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        $idea->title = $request->title;
        $idea->description = $request->description;
        $idea->categoryId = $request->category_id;

        // Handle Upload File
        if ($request->hasFile('document')) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($idea->filePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($idea->filePath);
            }

            $path = $request->file('document')->store('ideas', 'public');
            $idea->filePath = $path;
        }

        $idea->save();
        return redirect()->route('staff.mySubmissions')->with('success', 'Updated successfully!');
    }
    // view
    public function incrementView($ideaId)
    {
        $idea = Idea::find($ideaId);
        if ($idea) {
            $idea->increment('views');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
