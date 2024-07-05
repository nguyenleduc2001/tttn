<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SiteCartController extends Controller
{
    public function addcart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        $product_check = Product::where('id', $product_id)->first();
        if ($product_check != null) {
            $cart_check = Carts::where([['product_id', $product_id]])->exists();
            if ($cart_check) {
                return response()->json(['alert' => 'Đã thêm ' . $product_check->name . ' trước đó']);
            } else {
                $cart = new Carts();
                $cart->product_id = $product_id;
                $cart->qty = 1;
                $cart->save();
                return response()->json(['success' => 'Đã thêm ' . $qty . ' ' . $product_check->name . ' vào giỏ hàng']);
            }
        } else {
            return response()->json(['alert' => 'Sản phẩm không tồn tại']);
        }
    }

    public function updatecart(Request $request)
    {
        $product_id = $request->input('product_id');
        $qty = $request->input('qty');

        $cart_check = Carts::where([['product_id', $product_id]])->exists();
        if ($cart_check) {
            $cart = Carts::where([['product_id', $product_id]])->first();
            if ($cart->qty == $qty) {
                return response()->json(['alert' => 'Số lượng sản phẩm trong kho có hạn']);
            }
            $cart->qty = $qty;
            $cart->updated_at = now(); // Sử dụng hàm now() để lấy thời gian hiện tại
            $cart->save();
            return response()->json(['success' => 'Cập nhật giỏ hàng thành công']);
        } else {
            return response()->json(['alert' => 'Giỏ hàng không tồn tại']);
        }
    }
    public function showcarts()
    {
        $title = "Giỏ Hàng";
        $carts = Carts::orderBy('created_at', 'desc')->get();
        return view('frontend.show_carts', compact('title', 'carts'));
    }

    public function delcart(Request $request)
    {
        $product_id = $request->input('product_id');
        $cart_check = Carts::where([['product_id', $product_id]])->exists();
        if ($cart_check) {
            $cart = Carts::where([['product_id', $product_id]])->first();
            $cart->delete();
            return response()->json(['success' => 'Đã xóa sản phẩm khỏi giỏ hàng']);
        } else {
            return response()->json(['alert' => 'Giỏ hàng không tồn tại']);
        }
    }
}