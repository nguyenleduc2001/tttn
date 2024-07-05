<div class="row">
    <div class="col-7 mb-3">
        <label for="size">Kích Thước</label>
        <select name="size" id="size" class="form-control">
            <option value="" selected disabled>Chọn kích thước</option>
            <optgroup label="Kích cỡ hiện có">
                <option value="Cỡ nhỏ">Cỡ nhỏ</option>
                <option value="Cỡ phổ biến">Cỡ phổ biến</option>
                <option value="Cỡ lớn">Cỡ lớn</option>
            </optgroup>
            
        </select>
        @if ($errors->has('size'))
            <div class="text-danger">
                {{ $errors->first('size') }}
            </div>
        @endif
    </div>
    

    <div class="col-7 mb-3">
        <label for="color">Màu</label>
        <select name="color" id="color" class="form-control">
            <option value="" selected disabled>Chọn màu</option>
            <option value="Red">Red</option>
            <option value="Black">Black</option>
            <option value="Blue">Blue</option>
        </select>
        @if ($errors->has('color'))
            <div class="text-danger">
                {{ $errors->first('color') }}
            </div>
        @endif
    </div>
</div>
