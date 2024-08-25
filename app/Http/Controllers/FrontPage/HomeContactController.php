<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\CustomTemplate;
use Illuminate\Http\Request;

class HomeContactController extends Controller
{
    public function index()
    {
        $title = "Contact Us";
        $setting = CustomTemplate::first();
        if ($setting['maps_location'] && $setting['maps_location'] != "") {
            $setting['maps_preview'] = "<iframe src='" . $setting["maps_location"] . "' allowfullscreen class='w-100' height='500'></iframe>";
        }

        return view("pages.frontpage.contact-us", compact('title', 'setting'));
    }
}
