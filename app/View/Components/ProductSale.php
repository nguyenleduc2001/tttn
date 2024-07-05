<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Product_sale;
use Carbon\Carbon;
class ProductSale extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $currentDate = Carbon::now();
        $productsOnSale = Product_sale::where('date_begin', '<=', $currentDate)
            ->where('date_end', '>=', $currentDate)
            ->get();

        // Tạo một mảng chứa thông tin chi tiết của sản phẩm giảm giá
        $productSale = [];

        foreach ($productsOnSale as $productOnSale) {
            // Tìm sản phẩm tương ứng trong bảng Product
            $product = Product::find($productOnSale->product_id);
            // Kiểm tra xem sản phẩm có tồn tại không
            if ($product) {
                // Lấy danh sách hình ảnh sản phẩm
                $productImages = $product->images;
                // Chọn hình ảnh đầu tiên nếu có
                $image = null;
                if (count($productImages) > 0) {
                    $image = $productImages[0]->image;
                }
                // Thêm thông tin chi tiết vào mảng
                $productSale[] = [
                    'product' => $product,
                    'discount_percentage' => $productOnSale->discount_percentage,
                    'price_sale' => $productOnSale->price_sale,
                    'image' => $image, // Thêm thông tin hình ảnh
                ];
            }
        }
        return view('components.product-sale', compact('productSale'));
    }
    }

