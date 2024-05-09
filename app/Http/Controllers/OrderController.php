<?php

    namespace App\Http\Controllers;

    use App\Models\Order;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    class OrderController extends Controller
    {
        public function index()
        {
            $orders = Order::all();
            return response()->json(['orders' => $orders], 200);
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'notes' => 'nullable|string',
                'term' => 'required|string',
                'price' => 'required|integer',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $order = Order::create($request->all());

            return response()->json(['order' => $order], 201);
        }

        public function show($id)
        {
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            return response()->json(['order' => $order], 200);
        }

        public function update(Request $request, $id)
        {
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'notes' => 'nullable|string',
                'term' => 'required|string',
                'price' => 'required|integer',
                'tools' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $order->update($request->all());

            return response()->json(['order' => $order], 200);
        }

        public function destroy($id)
        {
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $order->delete();

            return response()->json(['message' => 'Order deleted successfully'], 200);
        }
    }
