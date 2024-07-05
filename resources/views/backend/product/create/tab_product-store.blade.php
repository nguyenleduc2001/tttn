<div class="row">
    <div class="col-6 mb-3">
            <label for="store_name">Tên Cửa Hàng</label>
            <input name="store_name" id="store_name" value="{{ old('store_name') }}" type="text" class="form-control "
                placeholder="vd:ABC_Store">
            @if ($errors->has('store_name'))
                <div class="text-danger">
                    {{ $errors->first('store_name') }}
                </div>
            @endif
        </div>
    <div class="col mb-3">
            <label for="price_store">Giá Nhập Hàng</label>
            <input name="price_store" id="price_store" type="number" class="form-control" value="{{ old('price_store') }}">
            @if ($errors->has('price_store'))
                <div class="text-danger">
                    {{ $errors->first('price_store') }}
                </div>
            @endif
        </div>
        <div class="col mb-3">
            <label for="qty">Số lượng</label>
            <input name="qty" id="qty" type="number" class="form-control" value="{{ old('qty') }}">
            @if ($errors->has('qty'))
                <div class="text-danger">
                    {{ $errors->first('qty') }}
                </div>
            @endif
        </div>
</div>