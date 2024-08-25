<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class HomeFaqController extends Controller
{
    public function list()
    {
        $title = "Frequently Asked Questions";
        $faqs = Faq::orderBy("id", "desc")->get();

        return view("pages.frontpage.faq", compact("title", "faqs"));
    }
}
