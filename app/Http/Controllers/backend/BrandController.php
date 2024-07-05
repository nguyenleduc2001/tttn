<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách thương hiệu';                                                                                                             #$title...
        $list = Brand::where('status', '!=', '0')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_sort_order .= "<coption value =''" . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }                                                                                     #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.index', compact('list', 'title', 'html_sort_order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'Tạo';
        $list = Brand::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_sort_order .= "<coption value =''" . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.brand.create", compact('html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $row = new Brand();
        $row->name = $request->name;
        $row->slug = Str::slug($request->name, '-');
        $row->sort_order = $request->sort_order;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at = now();
        $row->updated_at = now();
        $row->updated_by = 1;
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg'])) {
                $fileName = Str::slug($request->name, '-') . '.' . $extension;
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
            }
        }

        $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    public function show($id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Brand::where('status', '!=', '0')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_sort_order .= "<coption value =''" . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }
        $title = "Chi tiết mãu tin";
        return view('backend.brand.show', compact('row', 'title', 'html_sort_order', 'list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = brand::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            if ($item->sort_order == $row->sort_order) {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            } else {
                $html_sort_order .= "<option value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.brand.edit', compact('list', 'row', 'title', 'html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->name = $request->input('name');
        $row->slug = Str::of($request->input('name'))->slug('-');
        $row->sort_order = $request->input('sort_order');
        $row->metakey = $request->input('metakey');
        $row->metadesc = $request->input('metadesc');
        $row->updated_at = now();
        $row->updated_by = 1;
        $file = $request->file('image');
        if ($file != NULL) {
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extension;
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Cập nhật thành công']);
    }



    public function status($id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Thay đổi trạng thái không thành công']);
        }
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công']);
    }
    public function delete($id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Xóa không thành công']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = 1;
            $row->save();

            return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa thành công']);
        }
    }
    public function destroy($id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }
    public function trash()
    {
        $list = Brand::where('status', '=', '0')->orderBy('created_at', 'asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.trash', compact('list'));
    }
    public function restore($id)
    {
        $row = Brand::find($id);                                                                                           //$row1=Slider::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->status = 2;
        $row->save();
        return redirect()->route('brand.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục sản phẩm thành công']);
    }
}
