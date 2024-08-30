<?php

namespace Modules\Team\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Team\Entities\Team;

class TeamController extends Controller
{

    public function index()
    {
        auth()->user()->can('Team.index') ? '' : abort(403);
        $data = Team::with('media')->get();
        return view('team::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Team.create') ? '' : abort(403);
        return view('team::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Team.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = Team::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Team', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Team.edit') ? '' : abort(403);
        $data = Team::with('media')->find($id);

        return view('team::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Team.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Team::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Team', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Team.destroy') ? '' : abort(403);

        if (Team::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
