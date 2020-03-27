<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function paymentPage($objectId)
    {
        $object = \App\ObjectNew::findOrFail($objectId);
        $packs = \App\Pack::all();

        return view('payment.choose', ['packs' => $packs, 'object' => $object]);
    }

    public function paymentPageSubmit(Request $request, $orderId)
    {
        $object = \App\ObjectNew::findOrFail($orderId);
        $order = new \App\Order();
        $order->user_id = Auth::user()->id;

        if ($request->type == 'scenes') {
            $order->type = 1;
            $order->sum = ($object->unpaid_scenes + Auth::user()->paid_scenes) * ENV('SCENE_COST');
            $order->entity_id = $object->id;
        } else {
            $pack = \App\Pack::find($request->type);

            $order->type = 3; //оплата пакета панорам на этапе создания
            $order->sum = $pack->price;
            $order->entity_id = $object->id;
        }

        $order->save();

        return redirect()->route('pay', ['id' => $order->id]);
    }

    public function paymentRedirectPage($orderId)
    {
        return view('payment.redirect');
    }

    public function paymentRedirectPageSubmit($orderId)
    {
        $order = \App\Order::findOrFail($orderId);

        $info = $order->createPayment();

        if ($info->Success) {
            $order->external_id = $info->PaymentId;
            $order->link = $info->PaymentURL;
            $order->save();

            return redirect($info->PaymentURL);
        } else {
            $order->confirm();
        }
        return redirect($order->entity_url)->withErrors(['payment' => 'Ошибка оплаты.']);
    }

    public function paymentSuccess(Request $request)
    {
        $order = \App\Order::findOrFail($request->OrderId);
        if ($order->external_id != $request->PaymentId) return abort(404);
        $order->confirm();

        return view('payment.success', ['order' => $order]);
    }

    public function paymentError(Request $request)
    {
        $order = \App\Order::findOrFail($request->OrderId);
        if ($order->external_id != $request->PaymentId) return abort(404);
        $order->confirm();

        return view('payment.error', ['order' => $order]);
    }

    public function newObjectPayment($objectId)
    {
        $object = \App\ObjectNew::findOrFail($objectId);

        if ($object->unpaid_scenes > 0) {
            $order = new \App\Order();
            $order->user_id = Auth::user()->id;
            $order->type = 1; //оплата при создании тура
            $order->sum = $object->unpaid_scenes * ENV('SCENE_COST');
            $order->entity_id = $object->id;
            $order->save();

            return redirect()->route('pay', ['id' => $order->id]);
        }
        return redirect()->route($object->action_code.'.show', ['id' => $object->id]);
    }

    public function extend($objectId)
    {
        $object = \App\ObjectNew::findOrFail($objectId);

        $order = new \App\Order();
        $order->user_id = Auth::user()->id;
        $order->type = 4; //продление тура
        $order->sum = 99;
        $order->entity_id = $object->id;
        $order->save();

        return redirect()->route('pay', ['id' => $order->id]);
    }
}
