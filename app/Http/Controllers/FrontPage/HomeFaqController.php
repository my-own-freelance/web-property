<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\CustomTemplate;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeFaqController extends Controller
{
    public function list()
    {
        $title = "Frequently Asked Questions";
        $setting = CustomTemplate::first();
        if ($setting) {
            $title = $setting->web_title;
        }
        $faqs = Faq::orderBy("id", "desc")->get();

        return view("pages.frontpage.faq", compact("title", "faqs"));
    }
}
