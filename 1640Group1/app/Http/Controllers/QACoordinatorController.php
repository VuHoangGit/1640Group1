<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;

class QACoordinatorController extends Controller
{
    public function home() {
        return view("qa_coordinator.home");
    }

    public function categoryManagement(){
        $categories = Category::all();
        return view('qa_coordinator.categoryManagement', compact('categories'));
    }

    public function deleteCategory($categoryId){
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return redirect()->back();
    }

    public function viewUpdateCategory($categoryId){
        $category = Category::findOrFail($categoryId);
        return view('qa_coordinator.updateCategory', compact('category'));
    }

    public function updateCategory(Request $request, $categoryId){
        $request->validate([
            'name' => ['required'],
        ]);
        $category = Category::findOrFail($categoryId);
        $category->name = $request->name;

        $category->save();

        return redirect('/categoryManagement');
    }

    public function ideaManagement(){
        $ideas = Idea::all();
        return view('qa_coordinator.ideaManagement', compact('ideas'));
    }

    public function deleteIdea($ideaId){
        $idea = Idea::findOrFail($ideaId);
        $idea->delete();
        return redirect()->back();
    }

    public function viewUpdateIdea($ideaId){
        $idea = Idea::findOrFail($ideaId);
        return view('qa_coordinator.updateCategory', compact('idea'));
    }

}
