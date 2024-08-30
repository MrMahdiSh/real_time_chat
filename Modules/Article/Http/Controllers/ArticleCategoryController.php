<?php

namespace Modules\Article\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\ArticleCategory;
use Modules\Category\Entities\Category;
use Modules\Article\Entities\ArticleTag;

class ArticleCategoryController extends Controller
{

    public function index()
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = ArticleCategory::get();
        return view('article::category.index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Article.create') ? '' : abort(403);
        return view('article::category.create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Article.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $data['status'] = '1';
        $insert = ArticleCategory::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'ArticleCategory', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public function status($id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);

        $data = ArticleCategory::find($id);
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
        $data = ArticleCategory::find($id);

        return view('article::category.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = ArticleCategory::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ArticleCategory', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Article.destroy') ? '' : abort(403);

        if (ArticleCategory::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
