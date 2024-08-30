<?php

namespace Modules\Ticket\Http\Controllers;

use App\Helper\Core;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Doctor\Entities\Doctor;
use Modules\Ticket\Entities\Ticket;


class TicketController extends Controller
{

    public function ticket_content()
    {

        $doc_id = \request('doc_id', null);
        $data = Ticket::orderBy('id')->where('doc_id', $doc_id)->where('user_id', auth()->id());

        $doctor = Doctor::find($doc_id);

        if ($data) {
            $data->update(['seen_admin' => 0]);
        }
        $data = $data->get()->groupBy(function ($val) {
            return Core::ArticleDate($val->created_at, false);
        });


        return view('ticket::ajax.content_chat', compact('data', 'doctor'));

    }

    public function index()
    {
        auth()->user()->can('Ticket.index') ? '' : abort(403);

        $categories = Category::get();

        return view('ticket::index', compact('categories'));
    }


    public function show($doc_id)
    {
        auth()->user()->can('Ticket.create') ? '' : abort(403);

        return redirect()->route('Ticket.index')->with([ 'doc_id' => $doc_id]);

    }


    public function store(Request $request)
    {
        auth()->user()->can('Ticket.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $data['user_id'] = auth()->id();
        $data['sender_id'] = auth()->id();
        $data['seen'] = 1;
        $data['seen_admin'] = 0;
        $insert = Ticket::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Ticket', $insert->id);
            }


            return redirect()->back()->with(['success' => 'باموفقیت انجام شد', 'doc_id' => $data['doc_id']]);
        } else
            return Core::false();
    }




}
