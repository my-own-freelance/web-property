<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard Management Properti";

        return view("pages.admin.index", compact('title'));
    }
}
