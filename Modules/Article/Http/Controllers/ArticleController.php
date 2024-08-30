<?php

namespace Modules\Article\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleComment;
use Modules\Article\Entities\ArticleTag;
use Modules\Category\Entities\Category;
use Modules\Article\Entities\Article;
use Modules\Team\Entities\Team;

class ArticleController extends Controller
{

    public function index()
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = Article::with('media')->get();
        return view('article::article.index', compact('data'));
    }

    public function articles_status()
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = Article::with('media')->where('status', '0')->get();
        return view('article::article.index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Article.create') ? '' : abort(403);
        $categories = ArticleCategory::where('status', '1')->get();
        $tags = ArticleTag::where('status', '1')->get();
        $teams = Team::get();

        return view('article::article.create', compact('categories', 'teams', 'tags'));
    }


    public function store(Request $request)
    {
        auth()->user()->can('Article.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $data['status'] = '1';
        $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : '';
        $insert = Article::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Article', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public function status($id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);

        $data = Article::find($id);
        $status = (int)$data->status;
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;

        }
        $data->update(['status' => $status . '']);
        return Core::true();
    }

    public function edit($id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);
        $data = Article::with('media', 'user')->find($id);
        $categories = ArticleCategory::where('status', '1')->get();
        $tags = ArticleTag::where('status', '1')->get();
        $teams = Team::get();

        return view('article::article.edit', compact('data', 'categories', 'tags', 'teams'));
    }

    public function show($id)
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = ArticleComment::where('blog_id', $id)->get();

        return view('article::comment.index', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Article::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Article', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Article.destroy') ? '' : abort(403);

        if (Article::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
