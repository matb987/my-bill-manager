<?php 
$data = DB::table('users')->where('id', Auth::user()->id)->get()->first();
$user = Auth::user();
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="d-flex justify-content-center" style="font: 3.5vw Brush Script MT, Brush Script Std, cursive;"> {{Auth::user()->name}}</h2>

                    <form action="/updatewage">
                      <label for="wage">Income</label>
                      <input type="number" step="0.01" name="wage">
                      <input type="submit" value="Update">
                    </form>
                    <br><hl>
                    <form action="/updateqdate">
                      <label for="wage">Quartly Date</label>
                      <input type="date" value="" name="qdate">
                      <input type="submit" value="Update">
                    </form>
                    Current : @if (is_null($data->qdate)) Not Set @else {{$data->qdate}} @endif
      </div>
  </div>
</div>
</x-app-layout>
