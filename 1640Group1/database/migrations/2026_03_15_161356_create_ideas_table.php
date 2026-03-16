<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('ideas', function (Blueprint $table) {
        $table->id('ideaId');
        $table->foreignId('userId')->constrained('users', 'userId'); // Người đăng (Staff)
        $table->foreignId('categoryId')->constrained('categories', 'categoryId'); // Thuộc danh mục nào
        $table->string('filePath'); // Đường dẫn file word/docs lưu trên server
        $table->timestamps();
    });
}
};
