<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class spendingmanager extends Controller
{
 
    //Reset all spending
    public function reset() {
     DB::table('spendmanager')->where('userid', Auth::user()->id)->delete();

     return redirect('/spending');

 }

 public function delete() {
    DB::table('spendmanager')->where('id', $_GET['id'])->delete();
    return redirect('/spending');
 }

 //add bill
public function additem() {
    DB::table('spendmanager')->insert(['userid' => Auth::User()->id, 'item_name' => $_GET['item_name'], 'price' => $_GET['price']]);
      return redirect('/spending');
}

}
