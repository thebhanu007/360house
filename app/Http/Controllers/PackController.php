<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackController extends Controller
{
    public function buyPage()
    {
    	$packs = \App\Pack::all();

    	return view('packs.buy', ['packs' => $packs]);
    }

    public function buy($id)
    {
    	$pack = \App\Pack::findOrFail($id);

    	$order = new \App\Order();
        $order->user_id = Auth::user()->id;
        $order->type = 2; //оплата пакета
        $order->sum = $pack->price;
        $order->entity_id = $pack->id;
        $order->save();

        return redirect()->route('pay', ['id' => $order->id]);
    }
}
