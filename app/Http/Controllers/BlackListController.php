<?php

namespace App\Http\Controllers;

use App\Models\BlackListCountry;
use App\Models\BlackListIp;
use App\Models\email_black_list;
use Illuminate\Http\Request;

class BlackListController extends Controller
{
    public function countries()
    {
        $countries = BlackListCountry::get();
        return view('admin.black-list-countries', [
            'countries' => $countries,
        ]);
    }
    public function ipAddresses()
    {
        $ipAddresses = BlackListIp::get();
        return view('admin.black-list-ip-addresses',[
            'ipAddresses' => $ipAddresses,
        ]);
    }

    public function blockCountries()
    {
        if(request()->has('blockCountryForm')){
            $country = request()->validate([
                'country' => 'required|unique:black_list_countries,country'
            ]);

            BlackListCountry::create([
                'country' => strtolower($country['country']),
            ]);
            return back()->with('success', 'Country has been added to the Black List');

        }
    }
    public function blockIpAddress()
    {
        if (request()->has('blockIpForm')) {
            $ip = request()->validate([
                'ipAddress' => 'required|unique:black_list_ips,ip|ip'
            ]);

            BlackListIp::create([
                'ip' => strtolower($ip['ipAddress']),
            ]);
            return back()->with('success', 'Ip address has been added to the Black List');
        }
    }
    public function deleteCountry($id)
    {
        $country = BlackListCountry::findOrFail($id);
        $country->delete();
        return back()->with('success', 'Country has been removed from the Black List');
    }
    public function deleteIpAddress($id)
    {
        $ip = BlackListIp::findOrFail($id);
        $ip->delete();
        return back()->with('success', 'Ip address has been removed from the Black List');
    }

    public function emails()
    {
        $emails = email_black_list::get();
        return view('admin.email-black-list', [
            'emails' => $emails,
        ]);
    }

    public function blockEmails()
    {
        if (request()->has('blockEmailForm')) {
            $email = request()->validate([
                'email' => 'required|unique:email_black_lists,email'
            ]);

            email_black_list::create([
                'email' => strtolower($email['email']),
            ]);
            return back()->with('success', 'Email has been added to the Black List');
        }
    }

    public function deleteEmail($id)
    {
        $email = email_black_list::findOrFail($id);
        $email->delete();
        return back()->with('success', 'Email has been removed from the Black List');
    }
}
