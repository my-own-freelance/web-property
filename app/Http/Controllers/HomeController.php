<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Situs Jual Beli Property Terbaik";

        return view("pages.frontpage.index", compact("title"));
    }
}
