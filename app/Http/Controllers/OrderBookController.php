<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Models\Notification;


class OrderBookController extends Controller
{
    public function index()
    {
        return view("order-book");
    }

    public function showOrders()
    {
        $suggestions = Suggestion::all();
        return view("admin.show-orders",[
            "suggestions" => $suggestions
        ]);
    }

    public function store()
    {
        $details = request()->validate([
            "book_name" => "required",
            "book_url" => ["required", function($attr, $value, $fail){
                if(!str_contains($value, "https://www.amazon.com/" || !str_contains($value, "https://www.goodreads.com/")))
                    return $fail("The url you entered is invalid");
            }],
            "orderer_name" => "required",
            "orderer_email" => "required|email",
        ]);

        $details["notes"] = request("notes");

        if (Suggestion::create($details))
        {
              Notification::create([
                "username" => request("orderer_name"),
                "link" => "/admin/books-orders",
                "notif_type" => "order"

            ]);
            return back()->with("success", "Thank you, Your order has been submit successfully");
        }
        else
            return back()->with("failed","Sorry, something got wrong please try again");
    }

    public function delete($id){
        $suggestion = Suggestion::find($id);
        $suggestion->delete();
        return back();
    }
    public function done($id){
        $suggestion = Suggestion::findorFail($id);
        $suggestion->update(["status" => 1]);
        return back();
    }
}
