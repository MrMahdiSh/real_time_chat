<?php

namespace Modules\State\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\State\Entities\City;
use Modules\State\Entities\State;

class StateController extends Controller
{

    public function index()
    {
        auth()->user()->can('State.index') ? '' : abort(403);
        $data = State::orderBy('title')->with('cities')->get();
        return view('state::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('State.create') ? '' : abort(403);
        return view('state::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('State.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = State::create($data);

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
        $data = State::find($id);

        return view('state::edit', compact('data'));
    }

    public function show($id)
    {
        auth()->user()->can('State.create') ? '' : abort(403);
        $state = State::find($id);


        $data = City::where('state_id', $id)->orderBy('title')->get();


        return view('state::city.create', compact('data','state'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('State.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = State::find($id);
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

        if (State::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
