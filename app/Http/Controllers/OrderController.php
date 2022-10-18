<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(){
        try {
            $orders = Order::with(['orderItems', 'user'])->get();
            return response()->json($orders, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function show($reference)
    {
        try {
            $order = Order::with(['orderItems', 'user'])->where('reference', $reference)->first();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $reference = Str::random(10). '_' . Carbon::now();
            $request->validate([
                'user_id' => 'required|numeric',
                'items' => 'required|array', // [ {id: 1, quantity:10}]
            ]);
            $order = Order::create([
                'reference' => $reference,
                'user_id' => $request->user_id,
            ]);

            $subtotal = 0;
            $total = 0;
            foreach ($request->items as $item)
            {
                $price = Product::find($item['id'])->price;
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
                $subtotal = $subtotal + ($price * $orderItem->quantity);
            }
            $total = $total + ($subtotal * 1.19);
            $order->total = $total;
            $order->subtotal = $subtotal;
            $order->save();
            return response()->json([
                'order' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
