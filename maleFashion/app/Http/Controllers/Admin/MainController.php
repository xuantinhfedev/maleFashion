<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class MainController extends Controller
{
    public function index(){
        return view('admin.home', [
            'title' => 'Trang quản trị Amin'
        ]);
    }
}
