<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\DiscountCodeModel;
use App\Models\Cart;
use App\Models\ShippingChargeModel;

class PaymentController extends Controller
{
    // public function cart(Request $request)
    // {
    //     $data['meta_title'] = 'Shopping Cart';
    //     $data['meta_description'] = '';
    //     $data['meta_keywords'] = '';
    //     $data['cartItems'] = Cart::with('product')->get();

    //     return view('payment.cart', $data);
    // }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Shopping Cart';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        // Retrieve cart items where status is 1
        $cartItems = Cart::with('product')->where('status', 1)->get();

        // Calculate the total
        $totalPrice = $cartItems->sum(function($cart) {
            return $cart->total_price * $cart->quantity;
        });

        // Pass the cart items and total price to the view
        $data['cartItems'] = $cartItems;
        $data['totalPrice'] = $totalPrice;

        return view('payment.cart', $data);
    }

    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';
        $cartItems = Cart::with('product')->where('status', 1)->get();

        // Calculate the total
        $totalPrice = $cartItems->sum(function($cart) {
            return $cart->total_price * $cart->quantity;
        });

        // Pass the cart items and total price to the view
        $data['cartItems'] = $cartItems;
        $data['totalPrice'] = $totalPrice;

        $data['getShipping'] = ShippingChargeModel::getRecordActive();

        return view('payment.checkout', $data);
    }   

    public function addToCart(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'qty' => 'required|numeric|min:1'
        ]);

        // Find the product
        $product = ProductModel::findOrFail($request->product_id);
        $total = $product->price;

        // Calculate size price if provided
        $size_price = 0;
        if (!empty($request->size_id)) {
            $size = ProductSizeModel::find($request->size_id);
            $size_price = $size ? $size->price : 0;
        }

        // Calculate total price
        $total += $size_price;

        // Add product to cart
        $cart = new Cart();
        $cart->user_id = auth()->id(); 
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->qty;
        $cart->color_id = $request->color_id;
        $cart->size_id = $request->size_id;
        $cart->total_price = $total; // Save total price

        $cart->save();

        return redirect('cart')->with('success', 'Product added to cart successfully.');
    }


    public function cart_delete($id)
    {
        // Find the cart item and delete it
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }


    public function update_cart(Request $request)
    {
        foreach ($request->cart as $item) {
            Cart::where('id', $item['id'])->update([
                'quantity' => $item['qty']
            ]);
        }
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }



    public function apply_discount_code(Request $request)
    {
        $cartItems = Cart::all(); // Fetch cart items with products

        // Calculate the total price of all cart items
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->total_price * $cartItem->quantity;
        });

        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code); // Check the discount code
        if ($getDiscount) {
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $discount_amount;
            } elseif ($getDiscount->type == 'Percentage') {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json = [
                'status' => true,
                'discount_amount' => number_format($discount_amount, 2),
                'payable_total' => $payable_total,
                'message' => "Discount applied successfully"
            ];
        } else {
            $json = [
                'status' => false,
                'discount_amount' => '0.00',
                'payable_total' => $total,
                'message' => "Discount Code Invalid"
            ];
        }
        
        return response()->json($json);
        dd($request->all());
    }


}
