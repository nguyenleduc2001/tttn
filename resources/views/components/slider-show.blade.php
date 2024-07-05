

<div class="my-1">
    <section class="tr-footer">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($list_slider as $row_slider)
                    @if ($loop->first)
                        <div class="carousel-item active">
                            <img src="{{ asset('images/slider/' . $row_slider->image) }}" class="d-block w-100"
                                alt="{{ $row_slider->image }}">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img src="{{ asset('images/slider/' . $row_slider->image) }}" class="d-block w-100"
                                alt="{{ $row_slider->image }}">
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</div>
