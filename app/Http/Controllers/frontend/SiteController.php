<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Link;
use App\Models\Post;
use App\Models\Product;
use App\Models\Product_sale;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public $paginate = 6;
    public $min_price = 0;
    public $max_price = 1000000;
    public function index($slug = null)
    {
        if ($slug == null) {
            return  $this->home();
        } else {
            $link = Link::where('slug', '=', $slug)->first();
            if ($link == null) {
                $product = Product::where([['status', '=', '1'], ['slug', '=', $slug]])->first();
                if ($product != null) {
                    return $this->product_detail($product);
                } else {
                    $post_single = Post::where([['status', '=', '1'], ['slug', '=', $slug], ['type', '=', 'post']])->first();
                    if ($post_single != null) {
                        return $this->post_detail($post_single);
                    } else {
                        return $this->error_404($slug);
                    }
                }
            } else {
                $type = $link->type;
                switch ($type) {
                    case 'category': {
                            return $this->product_category($slug);
                        }
                    case 'brand': {
                            return $this->product_brand($slug);
                        }
                    case 'topic': {
                            return $this->post_topic($slug);
                        }
                    case 'page': {
                            return $this->post_page($slug);
                        }
                }
            }
        }
    }
    protected function home()
    {
        $title = "Trang chủ";
        $list_category = Category::where([
            ['parent_id', '=', 0],
            ['status', '=', 1]
        ])->orderBy('sort_order', 'asc')->get();

        $new_product = Product::with(['sale' => function ($query) {
            $query->whereRaw('? between date_begin and date_end', [now()]);
        }])->where('status', '1')->Orderby('created_at', 'desc')->take(4)->get();


        return view('frontend.home', compact('list_category', 'title', 'new_product',));
    }


    public function all_product()
    {
        $list_category = Category::where('status', '1')->orderBy('created_at', 'desc')->get();
        $list_brand = Brand::where('status', '1')->orderBy('created_at', 'desc')->get();
        if (isset($_GET['ten'])) {
            $ten = $_GET['ten'];
            $ten = $ten == 'z-a' ? 'desc' : 'asc';
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])->where('status', '1')->Orderby('name', $ten)->paginate($this->paginate);
        } elseif (isset($_GET['gia'])) {
            $gia = $_GET['gia'];
            $gia = $gia == 'giam' ? 'desc' : 'asc';
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])->where('status', '1')->Orderby('price', $gia)->paginate($this->paginate);
        } else {
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])->where('status', '1')->Orderby('created_at', 'desc')->paginate($this->paginate);
        }

        return view('frontend.all_product', compact('list_product', 'list_category', 'list_brand'));
    }
    protected function product_category($slug)
    {
        $row_cat = Category::where([['slug', '=', $slug], ['status', '=', '1']])->first();;
        $list_category_id = array();
        array_push($list_category_id, $row_cat->id);

        $list_category1 = Category::where([
            ['parent_id', '=', $row_cat->id],
            ['status', '=', 1]
        ])->orderBy('sort_order', 'asc')->get();
        if (count($list_category1) != 0) {
            foreach ($list_category1 as $row_cat1) {
                array_push($list_category_id, $row_cat1->id);
                $list_category2 = Category::where([['parent_id', '=', $row_cat1->id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
                if (count($list_category2) != 0) {
                    foreach ($list_category2 as $row_cat2) {
                        array_push($list_category_id, $row_cat2->id);
                        $list_category3 = Category::where([['parent_id', '=', $row_cat2->id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
                        if (count($list_category3) != 0) {
                            foreach ($list_category3 as $row_cat3) {
                                array_push($list_category_id, $row_cat3->id);
                            }
                        }
                    }
                }
            }
        }

        $product_list = Product::with(['sale' => function ($query) {
            $query->whereRaw('? between date_begin and date_end', [now()]);
        }])->where('status', '=', '1')
            ->whereIn('category_id', $list_category_id)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        $list_category = Category::where([
            ['parent_id', '=', 0],
            ['status', '=', 1]
        ])->orderBy('sort_order', 'asc')->get();
        return view('frontend.product-category', compact('row_cat', 'product_list', 'list_category'));
    }
    protected function product_brand($slug)
    {
        $brand = Brand::where([['status', '=', '1'], ['slug', '=', $slug]])->first();

        if (isset($_GET['ten'])) {
            $ten = $_GET['ten'];
            $ten = $ten == 'z-a' ? 'desc' : 'asc';
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])
                ->where('status', '1')
                ->where('brand_id', optional($brand)->id) // Sử dụng optional() để tránh lỗi khi $brand không tồn tại
                ->orderby('name', $ten)
                ->paginate($this->paginate);
        } elseif (isset($_GET['gia'])) {
            $gia = $_GET['gia'];
            $gia = $gia == 'giam' ? 'desc' : 'asc';
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])
                ->where('status', '1')
                ->where('brand_id', optional($brand)->id)
                ->orderby('price', $gia)
                ->paginate($this->paginate);
        } else {
            $list_product = Product::with(['sale' => function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            }])
                ->where('status', '=', '1')
                ->where('brand_id', optional($brand)->id)
                ->orderby('created_at', 'desc')
                ->paginate($this->paginate);
        }
        $brands = Brand::where('status', '!=', '0')->get();

        return view('frontend.product_brand', compact('list_product', 'brand', 'brands'));
    }

    public function all_post()
    {
        $list_post = Post::where([
            ['type', '=', 'post'],
            ['status', '=', '1']
        ])->orderBy('created_at', 'desc')->paginate(1);
        return view('frontend.all_post', compact('list_post'));
    }
    protected function post_topic($slug)
    {

        $topic = Topic::where([['status', '1'], ['slug', $slug]])->first();
        $list_post = Post::where([
            ['type', '=', 'post'],
            ['status', '=', '1'],
            ['topic_id', '=', $topic->id]
        ])->orderBy('created_at', 'desc')->paginate($this->paginate);
        return view('frontend.post_topic', compact('list_post', 'topic'));
    }
    protected function post_detail($post_single)
    {
        $topic = $post_single->topic;
        $list_post = Post::where([['status', '1'], ['topic_id', $topic->id], ['id', '!=', $post_single->id]])->Orderby('created_at', 'desc')->take(4)->get();
        return view('frontend.post_detail', compact('list_post', 'post_single'));
    }
    protected function post_page($slug)
    {
        $page = Post::where([['slug', '=', $slug], ['status', '=', 1]])->first();
        return view('frontend.post_page', compact('page'));
    }
    protected function product_detail($product)
    {
        if ($product == null) {
            return view('frontend.error_404');
        }
        $same_products = Product::with(['sale' => function ($query) {
            $query->whereRaw('? between date_begin and date_end', [now()]);
        }])->where([
            ['status', '=', '1'],
            ['category_id', '=', $product->category_id],
            ['id', '!=', $product->id]
        ])->orderBy('created_at', 'desc')->take(9)->get();
        return view('frontend.product-detail', compact('product', 'same_products'));
    }

    protected function error_404($slug)
    {
        return view('errors.404', compact('slug'));
    }
    // Add this method to your controller
    protected function product_sale()
    {
        $product_list = Product::with(['sale' => function ($query) {
            $query->whereRaw('? between date_begin and date_end', [now()]);
        }])
            ->whereHas('sale', function ($query) {
                $query->whereRaw('? between date_begin and date_end', [now()]);
            })
            ->where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('frontend.product-sale', compact('product_list'));
    }
}



// $cat = Category::where(['status', '!=', '0'])->orderBy('created_at', 'desc')->get()->first();
// $list_category = Category::where('status', '1')->orderBy('created_at', 'desc')->get();
// $list_brand = Brand::where('status', '1')->orderBy('created_at', 'desc')->get();
// if (isset($_GET['ten'])) {
//     $ten = $_GET['ten'];
//     $ten = $ten == 'z-a' ? 'desc' : 'asc';
//     $list_product = Product::with(['sale' => function ($query) {
//         $query->whereRaw('? between date_begin and date_end', [now()]);
//     }])->where('status', '1')->whereIn('category_id', [$cat->id])->Orderby('name', $ten)->paginate($this->paginate);
// } elseif (isset($_GET['gia'])) {
//     $gia = $_GET['gia'];
//     $gia = $gia == 'giam' ? 'desc' : 'asc';
//     $list_product = Product::with(['sale' => function ($query) {
//         $query->whereRaw('? between date_begin and date_end', [now()]);
//     }])->where('status', '1')->whereIn('category_id', [$cat->id])->Orderby('price', $gia)->paginate($this->paginate);
// } else {
//     $list_product = Product::with(['sale' => function ($query) {
//         $query->whereRaw('? between date_begin and date_end', [now()]);
//     }])->where('status', '=', '1')->whereIn('category_id', [$cat->id])->OrderBy('created_at', 'desc')->paginate($this->paginate);
// }
// return view('frontend.product-category', compact('list_product', 'cat'));



//sửa file mainmenu