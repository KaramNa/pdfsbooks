<?php

namespace App\Http\Controllers;

use App\Models\DCMA;
use App\Models\Notification;
use Illuminate\Http\Request;

class DCMAController extends Controller
{
    public function index()
    {
        $dcma_notes = DCMA::get();
        return view('dcma.index', [
            'dcma_notes' => $dcma_notes,
        ]);
    }
    public function show()
    {
        return view('dcma.show');
    }

    public function create()
    {
        return view('dcma.create');
    }
    public function store(Request $request)
    {
        $details = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'infringing_url' => 'required|url',
            'description' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);
        if (DCMA::create($details)) {
            Notification::create([
                "username" => request("name"),
                "link" => "/admin/dcma",
                "notif_type" => "dcma"

            ]);
            return back()->with('success', 'Thank you for your report, we\'ll study you request and send you the response ASAP');
        } else {
            return back()->with('failed', 'Sorry, something went wrong please try again in a minute');
        }
    }
    public function update($id)
    {
        $note = DCMA::findOrFail($id);
        $note->update(["status" => 1]);
        return back();
    }
    public function destroy($id)
    {
        $note = DCMA::findOrFail($id);
        $note->delete();
        return back();
    }
}
