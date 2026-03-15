<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AuthController; // KHÔI PHỤC LẠI: Gọi AuthController của bạn


//  (Đăng nhập, Quên mật khẩu)

Route::get('/', [PortalController::class, 'login'])->name('login');
Route::get('/forgotPassword', [PortalController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/newPassword', [PortalController::class, 'newPassword'])->name('newPassword');


// CÁC ROUTE DÀNH CHO ADMIN

Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin/newUser', [AdminController::class, 'newUser'])->name('admin.newUser');
Route::get('/admin/userManangement', [AdminController::class, 'userManagement'])->name('admin.userManagement');
 ADMIN:
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/socialmedia', [AdminController::class, 'socialmedia'])->name('admin.socialmedia');
Route::get('/admin/staffmanagement', [AdminController::class, 'staffmanagement'])->name('admin.staffmanagement');


// CÁC ROUTE XỬ LÝ FORM (MIDDLEWARE GUEST)
Route::middleware('guest')->group(function (){
    Route::View('/', 'portal.login')->name('login.show');
    Route::post('/', [PortalController::class, 'login'])->name('login');

    // Route::View('/forgotPassword', 'portal.forgotPassword')->name('forgotPassword');
    // Route::post('/forgotPassword',[PortalController::class, 'verifyQuestion'])->name('verifyQuestion');
    // Route::get('/newPassword',[PortalController::class,'newPassword'])->name('newPassword');

    Route::get('/resetPassword/{token}', [PortalController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/resetPassword', [PortalController::class, 'resetPassword'])->name('password.update');
});

// (Tính năng Sign Up)
Route::get('/sign-up', [AuthController::class, 'showSignUpForm']);
Route::post('/register', [AuthController::class, 'register']);


// Route này để nhận dữ liệu upload file:
Route::post('/submit-idea', [StaffController::class, 'storeIdea'])->name('idea.store');

// Đường dẫn để vào trang chủ của Staff
Route::get('/staff/home', [App\Http\Controllers\StaffController::class, 'home'])->name('staff.home');

// Route xử lý Đăng xuất
Route::post('/logout', [App\Http\Controllers\PortalController::class, 'logout'])->name('logout');

// Route để xử lý dữ liệu khi Admin bấm nút tạo tài khoản
Route::post('/admin/createNewUser', [App\Http\Controllers\AdminController::class, 'createNewUser'])->name('createNewUser');

// Trang xem danh sách bài đăng
Route::get('/admin/ideas', [AdminController::class, 'ideaList'])->name('admin.ideas');

// Route xử lý tải file (Sử dụng tính năng download của Laravel)
Route::get('/admin/download/{id}', function ($id) {
    $idea = \App\Models\Idea::findOrFail($id);
    $path = storage_path('app/public/' . $idea->filePath);
    return response()->download($path);
})->name('admin.download');

// Route cho trang danh sách ý tưởng
Route::get('/admin/ideas', [App\Http\Controllers\AdminController::class, 'ideaList'])->name('admin.ideas');
