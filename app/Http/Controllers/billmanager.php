<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class billmanager extends Controller
{
    //Reset all bills
    public function reset() {
     DB::table('bills')->where('userid', Auth::user()->id)->update(['status' => 'notpaid']);
     $lastmonth = DB::Table('bills')->where('userid', Auth::user()->id)->where('status', 'notpaid')->sum('price');
     DB::table('users')->where('id', Auth::user()->id)->update(['lastmonth' => $lastmonth]);

     return redirect('/dashboard');

 }
 // Mark item as paid
    public function paid() {
        DB::table('bills')->where('id', $_GET['id'])->update(['status' => 'paid']);
        if ($_GET['quarterly'] == 'on') {
            DB::table('bills')->where('id', $_GET['id'])->update(['due' => Carbon::now()->addMonth(3)]);
        }
        if ($_GET['quarterly'] == 'off') {
            DB::table('bills')->where('id', $_GET['id'])->update(['due' => Carbon::now()->addMonth(1)]);
        }
      return redirect('/dashboard');
 }
 public function delete() {
    DB::table('bills')->where('id', $_GET['id'])->delete();
    return redirect('/dashboard');
 }

 //add bill
public function additem() {
    if (empty($_GET['quarterly'])) {
        $quarterly = 'off';
    }
    elseif (!is_null($_GET['quarterly'])) {
         $quarterly = 'on';
     } 
    DB::table('bills')->insert(['userid' => Auth::User()->id, 'item_name' => $_GET['item_name'], 'price' => $_GET['price'], 'status' => 'notpaid', 'quarterly' =>  $quarterly, 'due' => $_GET['due']]);
      return redirect('/dashboard');
}


}
