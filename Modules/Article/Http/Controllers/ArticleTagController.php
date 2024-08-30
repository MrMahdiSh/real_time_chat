<?php

namespace Modules\Article\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Article\Entities\ArticleTag;

class ArticleTagController extends Controller
{

    public function index()
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = ArticleTag::get();
        return view('article::tag.index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Article.create') ? '' : abort(403);
        return view('article::tag.create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Article.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $data['status'] = '1';
        $insert = ArticleTag::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'ArticleTag', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public function status($id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);

        $data = ArticleTag::find($id);
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
        $data = ArticleTag::find($id);

        return view('article::tag.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = ArticleTag::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ArticleTag', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Article.destroy') ? '' : abort(403);

        if (ArticleTag::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
