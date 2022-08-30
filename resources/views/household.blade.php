<?php 
$readings = DB::Table('bills')->where('userid', Auth::user()->id)->get();
$thismonthtotal = DB::Table('bills')->where('userid', Auth::user()->id)->sum('price');
$totalleft = DB::Table('bills')->where('userid', Auth::user()->id)->where('status', 'notpaid')->sum('price');
$user = Auth::user();
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Total left to pay : £{{$totalleft}}   <div style="float: right;" class="lastmonth">Last Months Total: £{{$user->lastmonth}}</div></h2><br>
                    @if ($thismonthtotal < $user->lastmonth)
                    <p style="color: green;">You saved money this month</p>
                    @elseif ($thismonthtotal > $user->lastmonth)
                    <p style="color: red;">Your bills went up this month</p>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>

                          <th scope="col">Bill</th>
                          <th scope="col">Price</th>
                          <th scope="col">status</th>
                          <th>Due</th>
                          <th scope="col"></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($readings as $r)
                    
                    <tr>

                      <td><Strong class="align-middle">{{$r->item_name}}</Strong></td>
                      <td>£{{$r->price}}</td>
                      <td>

                        @if ($r->status != 'paid')
                        

                          <a href="/payitems?id={{$r->id}}&quarterly={{$r->quarterly}}"><button class="btn btn-dark" onclick="paid">Mark Paid</button></a>
                          @else
                          <p style="font: 30px Brush Script MT, Brush Script Std, cursive; color: green;">PAID</p>
                         
                          @endif
                      </td>
                      <td>{{$r->due}}</td>
                      <td>
                        <a href="/delitems?id={{$r->id}}"><button class="btn btn-danger">Delete Bill</button></a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <a href="/resetitems"><button class="btn btn-danger m-3">Reset All Paid</button></a>

        <form action="/additem" method="GET">
          <div class="form-group row"><label for="item_name">Bill Name</label>
              <input type="text" name="item_name">
          </div>
          <div class="form-group row">
              <label for="price">Price</label>
              <input type="number" step=".01" name="price">
          </div>
          <div class="form-group row">
            <label for="price">Due Date</label>
              <input type="date" name="due">
          </div>
          <div class="form-check">
            <label class="form-check-label" for="quarterly">Quarterly?</label>
            <input type="checkbox" name="quarterly" class="form-check-input" id="quarterly">
        </div>
        <div class="form-group row">
            <button type="submit" class="btn btn-info">Add Bill</button>
        </div>
    </form>

</div>
</div>
</div>
</div>
</x-app-layout>
