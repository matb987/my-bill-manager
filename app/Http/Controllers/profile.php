<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class profile extends Controller
{
    public function updatewage() {
        DB::table('users')->where('id', Auth::user()->id)->update(['wage' => $_GET['wage']]);
        return redirect('/profile');
    }
    //Update Quartly Date
    public function updateqdate() {
        DB::table('users')->where('id', Auth::user()->id)->update(['qdate' => $_GET['qdate']]);
        return redirect('/profile');
    }
}
