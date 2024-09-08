<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Contact;
use App\Models\CustomTemplate;
use App\Models\Faq;
use App\Models\Property;
use App\Models\PropertyCertificate;
use App\Models\PropertyTransaction;
use App\Models\PropertyType;
use App\Models\ReasonToChooseUs;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard Management Properti";
        $user = auth()->user();
        $propTransactions = 0;
        $propTypes = 0;
        $propCertificates = 0;
        $propAll = 0;
        $propPending = 0;
        $propApproved = 0;
        $propRejected = 0;
        $propDeleted = 0;
        $articles = 0;
        $faqs = 0;
        $agens = 0;
        $reviews = 0;
        $contacts = 0;
        $reasons = 0;

        if ($user->role == "agen") {
            $propPending = Property::where('agen_id', $user->id)->where('admin_approval', 'PENDING')->count();
            $propApproved = Property::where('agen_id', $user->id)->where('admin_approval', 'APPROVED')->count();
            $propRejected = Property::where('agen_id', $user->id)->where('admin_approval', 'REJECTED')->count();
            $propDeleted = Property::where('agen_id', $user->id)->onlyTrashed()->count();
            $propAll = $propPending + $propApproved + $propRejected + $propDeleted;
        }

        if ($user->role == "owner") {
            $propTransactions = PropertyTransaction::count();
            $propTypes = PropertyType::count();
            $propCertificates = PropertyCertificate::count();
            $articles = Article::count();
            $faqs = Faq::count();
            $agens = User::where("role", "agen")->count();
            $reviews = Review::count();
            $contacts = Contact::count();
            $reasons = ReasonToChooseUs::count();

            $propPending = Property::where('admin_approval', 'PENDING')->count();
            $propApproved = Property::where('admin_approval', 'APPROVED')->count();
            $propRejected = Property::where('admin_approval', 'REJECTED')->count();
            $propDeleted = Property::onlyTrashed()->count();
            $propAll = $propPending + $propApproved + $propRejected + $propDeleted;
        }

        $setting = CustomTemplate::first();
        if ($setting) {
            $title = $setting->web_title;
        }

        return view("pages.admin.index", compact('title', 'user', 'propTransactions', 'propTypes', 'propCertificates', 'propAll', 'propPending', 'propApproved', 'propRejected', 'propDeleted', 'articles', 'faqs', 'agens', 'reviews', 'contacts', 'reasons'));
    }
}
