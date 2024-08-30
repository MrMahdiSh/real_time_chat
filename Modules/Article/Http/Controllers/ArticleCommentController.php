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

class ArticleCommentController extends Controller
{

    public function index_comments()
    {
        auth()->user()->can('Article.index') ? '' : abort(403);
        $data = ArticleComment::where('status', '0')->get();

        return view('article::comment.index', compact('data'));
    }

    public function status($id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);

        $data = ArticleComment::find($id);
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
        $data = ArticleComment::find($id);

        return view('article::comment.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Article.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = ArticleComment::find($id);
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

        if (ArticleComment::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
