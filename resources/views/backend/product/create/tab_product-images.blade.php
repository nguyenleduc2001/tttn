<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<title>Hiển thị ảnh đã chọn</title>
<style>
    /* CSS để hiển thị ảnh */
    .preview-container {
        display: flex;
        flex-wrap: wrap;
    }
    .image-preview {
        max-width: 100px;
        max-height: 100px;
        margin: 5px;
    }
</style>

<div class="row">
    <div class="form_images">
        <div class="card">
            <div class="top">
                <p>Kéo và thả để thêm ảnh</p>
            </div>
            <div class="drag-area">
                <span class="visible">
                    Kéo và thả ảnh vào đây hoặc
                    <span class="select" role="button">Thêm</span>
                </span>
                <span class="on-drop">Thả ra</span>
                <input name="images[]" type="file" class="file" multiple accept="image/*" />
            </div>

            <div class="container">
                @if ($errors->has('images'))
                    <div class="text-danger">
                        {{ $errors->first('images') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="preview-container"></div>

<script>
    var fileInput = document.querySelector('.file');
    fileInput.addEventListener('change', function() {
        displaySelectedImages(this.files);
    });

    function displaySelectedImages(files) {
        var previewContainer = $('.preview-container');
        previewContainer.empty();
        if (files.length > 5) {
            alert('Chỉ được chọn tối đa 5 ảnh');
            return;
        }

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = $('<img>').addClass('image-preview').attr('src', e.target.result);
                previewContainer.append(image);
            }
            reader.readAsDataURL(files[i]);
        }
    }
</script>