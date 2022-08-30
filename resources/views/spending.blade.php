<?php 
$readings = DB::Table('spendmanager')->where('userid', Auth::user()->id)->get();
$total = DB::Table('spendmanager')->where('userid', Auth::user()->id)->sum('price');
$thismonthtotal = DB::Table('bills')->where('userid', Auth::user()->id)->sum('price');
$afterbills = Auth::user()->wage - $thismonthtotal;
$left = $afterbills - $total;
$left = round($left, 2);
$savings = 20 * $afterbills /100 ;
$savings = round($savings, 2);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Spending') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Total Spent : £{{$total}}  <div style="float: right;" class="lastmonth">Left after bills: £{{$afterbills}}<br><p style="color: @if ($left > 0) green @else red @endif">Remaining: £{{$left}}</p>
                    Recommended Savings: £@if ($savings > 0){{$savings}} @else 0 @endif</div></h2>
                    <table class="table">
                      <thead>
                        <tr>

                          <th scope="col">Item</th>
                          <th scope="col">Price</th>
                          <th scope="col"></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($readings as $r)
                    
                    <tr>

                      <td><Strong class="align-middle">{{$r->item_name}}</Strong></td>
                      <td>£{{$r->price}}</td>
                      <td>
                        <a href="/spendingdelitems?id={{$r->id}}"><button class="btn btn-danger">Delete Bill</button></a>
                      </td>
                      </tr>

                      @endforeach
                  </tbody>
              </table>
              <a href="/spendingresetitems"><button class="btn btn-danger m-3">Reset Spending</button></a>
              
              <form class="form-inline" action="/spendingadditem" method="GET">
                  <div class="form-group row">
                  <label>Item Name</label>
                  <input type="text" name="item_name">
                  </div>
                  <div class="form-group row">
                  <label>Price</label>
                  <small class="text-muted">do not add £ just input number</small>
                  <input hint="" type="number" step=".01" name="price">
                  <button type="submit" class="btn btn-info">Add payment</button>
                </div>
              </form>

          </div>
      </div>
  </div>
</div>
</x-app-layout>
