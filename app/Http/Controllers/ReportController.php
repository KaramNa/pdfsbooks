<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Notification;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportTheLink($slug)
    {
        $email = null;
        if (request("email"))
        $email = request()->validate([
            "email" => "email"
        ])["email"];
        try {
            if (Report::create([
                "reported_link" => "https://pdfsbooks.com/book/" . $slug,
                "message" => request("report_message"),
                "email" => $email
            ])){
                Notification::create([
                    "username" => "somebody",
                    "link" => "https://pdfsbooks.com/reported-links",
                    "notif_type" => "report"
                ]);
                return back()->with("success", "Thank you for the report, we'll try to fix the link as soon as possible, and sorry for the inconvenience");
            }
        } catch (\Throwable $e) {
            return back()->with("failed", "The report message should be less than 300 characters");
        }
    }

    public function showReportedLinks()
    {
        $reports = Report::get();
        return view("reported-links", [
            "reports" => $reports
        ]);
    }

    public function deleteReport($id)
    {
        Report::find($id)->delete();
        return back();
    }
}
