<?php

namespace Modules\State\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\State\Entities\City;
use Modules\State\Entities\State;

class CityController extends Controller
{


    public function store(Request $request)
    {
        auth()->user()->can('State.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = City::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'State', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('State.edit') ? '' : abort(403);
        $data = City::find($id);

        return view('state::city.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('State.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = City::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'State', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('State.destroy') ? '' : abort(403);

        if (City::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
