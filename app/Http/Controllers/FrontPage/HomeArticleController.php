<?php

namespace App\Http\Controllers\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeArticleController extends Controller
{
    public function list(Request $request)
    {
        $title = 'List Artikel';
        $query = Article::query();

        if ($request->query("search") && $request->query("search") != "") {
            $searchValue = $request->query("search");
            $query->where('title', 'like', '%' . $searchValue . '%')
                ->orWhere('excerpt', 'like', '%' . $searchValue . '%')
                ->orWhere('code', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%');
        }

        $articles = $query->orderBy('id', 'desc')
            ->where("is_publish", "Y")
            ->paginate(6)
            ->appends($request->query())
            ->through(function ($article) {
                return (object)[
                    'id' => $article->id,
                    'code' => $article->code,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt,
                    'image' => url("/") . Storage::url($article->image),
                    'views' => $article->views,
                    'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                    'date' => Carbon::parse($article->created_at)->format('d F, Y'),
                ];
            });

        $popular = Article::orderBy("id", "desc")
            ->limit(3)
            ->where("is_publish", "Y")
            ->orderBy("views", "desc")
            ->get()
            ->map(function ($article) {
                return (object)[
                    'id' => $article->id,
                    'title' => $article->title,
                    'image' => url("/") . Storage::url($article->image),
                    'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                    'date' => Carbon::parse($article->created_at)->format('d F, Y'),
                ];
            });

        return view('pages.frontpage.list-article', compact('title', 'articles', 'popular'));
    }

    public function detail($code, $slug)
    {
        $article = Article::where('code', $code)
            ->where('slug', $slug)
            ->where('is_publish', 'Y')
            ->first();

        if (!$article) {
            return abort(404);
        }

        $title = $article->title;
        $data["views"] = $article->views + 1;
        $article->update($data);

        $article['image'] = url("/") . Storage::url($article->image);
        $article['date'] = Carbon::parse($article->created_at)->format('d F, Y');

        $recentPosts = Article::orderBy("id", "desc")
            ->limit(3)
            ->where("is_publish", "Y")
            ->where("code", "!=", $code)
            ->get()
            ->map(function ($article) {
                return (object)[
                    'id' => $article->id,
                    'title' => $article->title,
                    'image' => url("/") . Storage::url($article->image),
                    'url' => url('/') . '/cari-artikel/view/' . $article['code'] . '/' . $article['slug'],
                    'date' => Carbon::parse($article->created_at)->format('d F, Y'),
                ];
            });

        return view("pages.frontpage.detail-article", compact("title", "article", "recentPosts"));
    }
}
