<div class="row">
    <div class="col-6">
        <div class="container-image">
            <input name="images[]" id="file-input" type="file" multiple value="{{ old('images.*') }}"
                class="form-control btn-sm">
            <label for="file-input">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                &nbsp; Hình ảnh mô tả
            </label>
            <div id="container" class="image-container">
                @if ($errors->has('images[]'))
                    <div class="text-danger">
                        {{ $errors->first('images[]') }}
                    </div>
                @else
                    @foreach ($images as $image)
                        <img class="horizontal-image" src="{{ asset('images/product/' . $image->image) }}"
                            alt="Product Image">
                    @endforeach
                @endif
            </div>
            <ul id="files-list"></ul>
        </div>
    </div>
</div>

<style>
    .container-image {
        position: relative;
        overflow: hidden;
    }

    #container {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        margin-top: 10px;
    }

    .horizontal-image {
        max-width: 100px;
        /* Set a maximum width for each image */
        height: auto;
        margin-right: 10px;
        /* Add some margin between images for spacing */
    }

    #file-input {
        display: none;
    }
</style>
