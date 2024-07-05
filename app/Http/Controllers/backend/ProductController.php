<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_images;
use App\Models\Product_sale;
use App\Models\User;
use App\Models\Product_color;
use App\Models\Product_size;
use App\Models\Product_store;
use App\Models\Product_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    public function index()
    {
        //$list=Product::all();//try van tat ca->with(['category','brand'])
        $product = Product::join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->where('product.status', '!=', '0')
            ->orderBy('product.created_at', 'desc')
            ->select("product.*", "category.name as category_name", "brand.name as brand_name")
            ->get();

        $title = 'Tất Cả Sản Phẩm';
        return view("backend.product.index", compact('product', 'title'));
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function create()
    {
        $title = 'Thêm Sản Phẩm';
        $list_brand = Brand::where('status', '!=', '0')
            ->get();
        $list_category = Category::where('status', '!=', '0')
            ->get();
        $html_category_id = "";
        $html_brand_id = "";

        foreach ($list_category as $category) {
            $html_category_id .= "<option value='" . $category->id . "'" . (($category->id == old('category_id')) ? ' selected ' : ' ') . ">" . $category->name . "</option>";
        }
        foreach ($list_brand as $brand) {
            $html_brand_id .= "<option value='" . $brand->id . "'" . (($brand->id == old('brand_id')) ? 'selected' : ' ') . ">" . $brand->name . "</option>";
        }

        return view("backend.product.create", compact('title', 'html_category_id', 'html_brand_id'));
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function show($id)
    {

        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        }
        $user_create = User::find($product->created_by);
        $user_update = User::find($product->updated_by);
        $product_images = Product_images::where('product_id', '=', $id)->get();
        $title = 'Chi Tiết Sản Phẩm';
        return view("backend.product.show", compact('title', 'product', 'product_images', 'user_create', 'user_update'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function trash()
    {
        //$list=Product::all();//try van tat ca
        $product = Product::join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->where('product.status', '=', '0')
            ->orderBy('product.updated_at', 'desc')
            ->select("product.*", "category.name as category_name", "brand.name as brand_name")
            ->get();
        $title = 'Thùng rác sản phẩm';
        return view("backend.product.trash", compact('product', 'title'));
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function status($id)
    {

        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        if ($product->brand->status != 1) {
            $brand_name = $product->brand->name;
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => "Bạn cần thay đổi trạng thái của thương hiệu $brand_name trước  "]);
        }
        if ($product->category->status != 1) {
            $category_name = $product->category->name;
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => "Bạn cần thay đổi trạng thái của danh mục $category_name trước  "]);
        }
        $product->status = ($product->status == 1) ? 2 : 1;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function restore($id)
    {

        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        if ($product->brand->status == 0) {
            $brand_name = $product->brand->name;
            return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Thương hiệu $brand_name đang trong thùng rác  "]);
        }
        if ($product->category->status == 0) {
            $category_name = $product->category->name;
            return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Danh mục $category_name đang trong thùng rác  "]);
        }

        // if ($request->filled('size')) {
        //     $product_option = new Product_size();
        //     $product_option->size = $request->size;
        //     $product->options()->save($product_option);
        // }
        // if ($request->filled('color')) {
        //     $product_option = new Product_color();
        //     $product_option->color = $request->color;
        //     $product->options()->save($product_option);
        // }
        // /////


        $product->status = 2;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => 'Phục hồi thành công!']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function destroy($id)
    {

        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        if ($product->delete()) {
            $path = 'images/product/';

            $list_product_images = $product->images;
            foreach ($list_product_images as $product_images) {
                if (File::exists(public_path($path . $product_images->image))) {
                    File::delete(public_path($path . $product_images->image));
                }
            }
            $product->sale()->delete();
            $product->images()->delete();
            return redirect()->route('product.trash')->with('message', ['type' => 'success', 'msg' => 'Xóa vĩnh viễn thành công!']);
        }
        return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => 'Xóa thất bại!']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function trash_multi(Request $request)
    {
        $path = 'images/product/';

        if (isset($request['DELETE_ALL'])) {
            if (isset($request->checkId)) {
                $list_id = $request->input('checkId');
                $count_max = sizeof($list_id);
                $count = 0;
                foreach ($list_id as $id) {
                    $product = Product::find($id);
                    if ($product == null) {
                        return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Có mẫu tin không tồn tại!&&Đã xóa $count/$count_max !"]);
                    }
                    if ($product->delete()) {
                        $path = 'images/product/';
                        $list_product_images = $product->images;
                        foreach ($list_product_images as $product_images) {
                            if (File::exists(public_path($path . $product_images->image))) {
                                File::delete(public_path($path . $product_images->image));
                            }
                        }
                        $product->sale()->delete();
                        $product->images()->delete();
                        $count++;
                    }
                }
                return redirect()->route('product.trash')->with('message', ['type' => 'success', 'msg' => "Xóa vĩnh viễn thành công $count/$count_max !"]);
            } else {
                return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request['RESTORE_ALL'])) {
            if (isset($request->checkId)) {
                $list_id = $request->input('checkId');
                $count_max = sizeof($list_id);
                $count = 0;
                foreach ($list_id as $id) {
                    $product = Product::find($id);
                    if ($product == null) {
                        return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Có mẫu tin không tồn tại!&&Đã phục hồi $count/$count_max !"]);
                    }
                    if ($product->brand->status == 0) {
                        $brand_name = $product->brand->name;
                        return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Thương hiệu $brand_name đang trong thùng rác &&Đã phục hồi $count/$count_max  "]);
                    }
                    if ($product->category->status == 0) {
                        $category_name = $product->category->name;
                        return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => "Danh mục $category_name đang trong thùng rác &&Đã phục hồi $count/$count_max "]);
                    }
                    $product->status = 2;
                    $product->updated_at = date('Y-m-d H:i:s');
                    $product->save();
                    $count++;
                }
                return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => "Phục hồi thành công $count/$count_max !"]);
            } else {
                return redirect()->route('product.trash')->with('message', ['type' => 'danger', 'msg' => 'Chưa chọn mẫu tin!']);
            }
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $product->status = 0;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();
        return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => 'Xóa thành công!&& vào thùng rác để xem!!!']);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function delete_multi(Request $request)
    {
        if (isset($request->checkId)) {
            $list_id = $request->input('checkId');
            $count_max = sizeof($list_id);
            $count = 0;
            foreach ($list_id as $id) {
                $product = Product::find($id);
                if ($product == null) {
                    return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => "Có mẫu tin không tồn tại!Đã xóa $count/$count_max ! "]);
                }
                $product->status = 0;
                $product->updated_at = date('Y-m-d H:i:s');
                $product->save();
                $count++;
            }
            return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => "Xóa thành công $count/$count_max !&& Vào thùng rác để xem!!!"]);
        } else {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Chưa chọn mẫu tin!']);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function store(ProductStoreRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->detail = $request->detail;
        $product->metakey = $request->metakey;
        $product->metadesc = $request->metadesc;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->created_at = now();

        if ($product->save()) {
            // Kiểm tra và lưu thông tin giảm giá nếu có
            if ($request->filled('price_sale')) {
                $product->sale()->create([
                    'price_sale' => $request->price_sale,
                    'date_begin' => $request->date_begin,
                    'date_end' => $request->date_end,
                ]);
            }

            // Kiểm tra và lưu hình ảnh
            if ($request->hasFile('images')) {
                $path = 'images/product/';
                foreach ($request->file('images') as $file) {
                    $filename = $product->slug . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($path, $filename);
                    $product->images()->create(['image' => $filename]);
                }
            }

            // Kiểm tra và lưu thông tin tùy chọn sản phẩm
            // if ($request->filled('size') || $request->filled('color')) {
            //     $product->options()->create([
            //         'size' => $request->size,
            //         'color' => $request->color,
            //     ]);
            // }

            // Kiểm tra và lưu thông tin cửa hàng
            // if ($request->filled('price_store')) {
            //     $product->store()->create([
            //         'store_name' => $request->store_name,
            //         'price_store' => $request->price_store,
            //         'qty' => $request->qty,
            //     ]);
            // }

            return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công!']);
        } else {
            return redirect()->route('product.create')->with('message', ['type' => 'danger', 'msg' => 'Thêm thất bại!!']);
        }
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit($id)
    {
        $title = 'Cập Nhật Sản Phẩm';
        $product = Product::where('product.id', $id)
            ->join('product_sale', 'product.id', '=', 'product_sale.product_id')
            ->select('product.*', 'product_sale.price_sale', 'product_sale.date_begin', 'product_sale.date_end')
            ->first();

        if ($product == null) {
            return redirect()->route('product.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        }

        // Fetch existing images associated with the product
        $images = Product_images::where('product_id', $id)->get();

        $list_brand = Brand::where('status', '!=', '0')->get();
        $list_category = Category::where('status', '!=', '0')->get();

        $str_option_category = "";
        $str_option_brand = "";

        foreach ($list_category as $category) {
            $str_option_category .= "<option value='" . $category->id . "'" . (($category->id == old('category_id', $product->category_id)) ? 'selected' : ' ') . ">" . $category->name . "</option>";
        }

        foreach ($list_brand as $brand) {
            $str_option_brand .= "<option value='" . $brand->id . "'" . (($brand->id == old('brand_id', $product->brand_id)) ? 'selected' : ' ') . ">" . $brand->name . "</option>";
        }

        return view("backend.product.edit", compact('title', 'product', 'str_option_category', 'str_option_brand', 'images'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $request->validate([
            'name' => [
                Rule::unique('product', 'name')->ignore($id),
                Rule::unique('brand', 'name'),
                Rule::unique('category', 'name'),
                Rule::unique('topic', 'name'),
                Rule::unique('post', 'title'),
            ]
        ], [
            'name.unique' => 'Tên đã được sử dụng. Vui lòng chọn tên khác.'
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->detail = $request->detail;
        $product->metakey = $request->metakey;
        $product->metadesc = $request->metadesc;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->qty = $request->qty;
        $product->price = $request->price;
        // $product->level = 1;
        $product->status = $request->status;
        $product->updated_at = date('Y-m-d H:i:s');
        //upload file


        if ($product->save()) {
            $product_sale = $product->sale;
            $product_sale->price_sale = $request->price_sale;
            $product_sale->date_begin = $request->date_begin;
            $product_sale->date_end = $request->date_end;
            $product->sale()->save($product_sale);
            if ($request->hasFile('images')) {
                $path = 'images/product/';
                $files = $request->file('images');

                $list_product_images =  $product->images;
                $count = 1;

                foreach ($list_product_images as $product_images) {

                    $product_images->delete();
                    if (File::exists(public_path($path . $product_images->image))) {
                        File::delete(public_path($path . $product_images->image));
                    }
                }
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = $product->slug . '-' . $count . '.' . $extension;
                    $file->move($path, $filename);
                    $product_images = new Product_images();
                    $product_images->image = $filename;
                    $product_images->product_id = $product->id;

                    $product->images()->save($product_images);
                    $count++;
                }
            }
            return redirect()->route('product.index')->with('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
        } else {

            return redirect()->route('product.edit')->with('message', ['type' => 'danger', 'msg' => 'Cập nhật thất bại!!']);
        }
    }
    public function image($id)
    {
        $title = 'Hình ảnh';
        $product = Product::find($id);
        $image = Product_images::where('product_id', $id)->get();

        // dd($image);
        return view('backend.product.image', compact('product', 'image',  'title'));
    }

    public function imageUpload(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
        ], [
            'image.required' => 'Hình ảnh không được để trống.',
            'image.min' => 'Bạn cần tải lên ít nhất 2 hình ảnh.',
            'image.*.image' => 'Tập tin phải là hình ảnh.',
            'image.*.mimes' => 'Hình ảnh phải có định dạng :mimes.',
            'image.*.max' => 'Kích thước hình ảnh tối đa là 2048KB.',


        ]);
        $product = Product::find($id);
        // dd($product->images);
        $max = Product_images::where('product_id', $id)->count('sort_order');
        // dd($max);
        if ($request->has('image')) {
            $count = $max + 1;
            $path_dir = "images/product/";
            $array_file = $request->file('image');
            foreach ($array_file as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $product->slug . '-' . $count . '.' . $extension;
                $file->move($path_dir, $filename);
                $product_image = new Product_images();
                $product_image->product_id = $product->id;
                $product_image->sort_order = $count;
                $product_image->image = $filename;
                // dd($product_image);
                $product_image->save();
                $count++;
            }
        }
        return redirect()->route('product.image', ['product' => $id])->with('message', ['type' => 'success', 'msg' => 'Thêm hình ảnh thành công']);
    }
    public function imageDelete(Request $request)
    {

        $path_dir = "images/product/";
        $imageId = $request->input('img_id');
        $prodID = $request->input('prod_id');
        $count = Product_images::where('product_id', $prodID)->count();

        if ($count > 2) {
            if (Product_images::where('id', $imageId)) {
                $imageItem = Product_images::where('id', $imageId)->first();
                // dd($imageItem);
                $path_image_delete = public_path($path_dir . $imageItem->image);
                File::delete($path_image_delete);
                $imageItem->delete();
                return  response()->json(['success' => 'Đã xóa thành công']);
            } else {
                return response()->json(['alert' => 'Không tồn tại hình ảnh']);
            }
        } else {
            return response()->json(['alert' => 'Số lượng hình ảnh không thể ít hơn 2']);
        }
    }
}