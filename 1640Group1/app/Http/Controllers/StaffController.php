<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;

class StaffController extends Controller
{
    public function home() {
        return view('staff.home');
    }
    public function authSetup(){
        $user = User::find(session('loginId'));
        if(!$user->favorite_animal==null){
            return redirect('/staff/home');
        }
        return view('staff.authSetup');
    }
    public function authQuestionSetup(Request $request){
        $request->validate([
            'favorite_animal' => ['required'],
            'favorite_color' => ['required'],
            'child_birth_year' => ['required'],
            'term' => ['required']
        ]);
        $user = User::find(session('loginId'));
        $user->update([
            'favorite_animal' => $request->favorite_animal,
            'favorite_color' => $request->favorite_color,
            'child_birth_year' => $request->child_birth_year,
            'acceptTerms' => true
        ]);
        return redirect('/staff/home');
    }
    public function storeIdea(Request $request)
    {
        // 1. Kiểm tra dữ liệu và file (Tối đa 10MB, đuôi doc, docx, pdf)
        $request->validate([
            'category_id' => 'required|exists:categories,categoryId',
            'document'    => 'required|file|mimes:doc,docx,pdf|max:10240',
        ]);

        // 2. Cất file thực tế vào thư mục: storage/app/public/ideas
        $path = $request->file('document')->store('ideas', 'public');

        // 3. Lưu thông tin (đường dẫn file, người đăng, chuyên mục) vào Database
        Idea::create([
            'userId'     => auth()->id(), // Tự động lấy ID của người đang đăng nhập
            'categoryId' => $request->category_id,
            'filePath'   => $path,
        ]);

        // 4. Báo thành công và tải lại trang
        return redirect()->back()->with('success', 'Gửi ý tưởng và file thành công!');
    }
}
