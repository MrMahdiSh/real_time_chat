<?php

namespace Modules\Category\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;

class CategoryController extends Controller
{

    public function index()
    {
        auth()->user()->can('Category.index') ? '' : abort(403);
        $data = Category::with('media')->get();
        return view('category::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Category.create') ? '' : abort(403);

        return view('category::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Category.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Category::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Category', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Category.edit') ? '' : abort(403);
        $data = Category::with('media')->find($id);

        return view('category::edit', compact('data'));
    }




    public function update(Request $request, $id)
    {
        auth()->user()->can('Category.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Category::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Category', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Category.destroy') ? '' : abort(403);

        if (Category::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
