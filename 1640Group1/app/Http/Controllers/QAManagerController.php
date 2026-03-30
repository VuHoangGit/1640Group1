<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QAManagerController extends Controller
{
        public function home() {
        return view("qa_manager.home");
    }
}
