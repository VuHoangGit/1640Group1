<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // 1. Báo cho Laravel biết khóa chính của bảng là 'userId' (thay vì 'id' mặc định)
    protected $primaryKey = 'userId';

    /** * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // 2. Mở khóa cho phép lưu dữ liệu vào các cột tùy chỉnh
    protected $fillable = [
        'username',
        'fullName',
        'phone',
        'email',
        'passwordHash',
        'role',
        'acceptTerms',
        'isActive',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    // 3. Ẩn cột 'passwordHash' khi truy xuất dữ liệu người dùng (để bảo mật)
    protected $hidden = [
        'passwordHash',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'passwordHash' => 'hashed', // Tự động mã hóa Hash cho cột passwordHash
            'acceptTerms' => 'boolean',
            'isActive' => 'boolean',
        ];
    }

    // 4. Hàm BẮT BUỘC: Giúp chức năng Đăng nhập của Laravel tìm đúng cột mật khẩu
    public function getAuthPassword()
    {
        return $this->passwordHash;
    }
}
