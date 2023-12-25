<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $payPal;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function checkout()
    {
        $tax = 0.07;
        return view('main.checkout', ['tax' => $tax]);
    }

    public function placeOrder(Request $request)
    {
        $order = $this->orderRepository->storeOrderDetails($request->all());
//        dd($order);
        if ($order) {
            \Cart::clear();
            return view('main.success', ['order' => $order]);
//            $this->payPal->processPayment($order);
        }
        return redirect()->back()->with('message', 'Order not placed');
    }

    public function complete(Request $request)    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('app.success', compact('order'));
    }

}
