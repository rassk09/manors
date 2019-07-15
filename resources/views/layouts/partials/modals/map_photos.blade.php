@if (isset($event) && $event->photos->count() > 0)
    <div tabindex="-1" class="modal fade modal-gallery jsModalGallery">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <a data-dismiss="modal" class="modal-gallery__close"></a>
                    <div class="modal-gallery__inner">
                        <div class="modal-gallery__body jsModalGalleryBig">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($event->photos as $photo)
                                        <div class="swiper-slide">
                                            <img data-src="{{ $photo->getImage('big') }}" class="swiper-lazy">
                                            <div class="swiper-lazy-preloader"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-gallery__foot jsModalGalleryThumb">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($event->photos as $photo)
                                        <div class="swiper-slide">
                                            <a href="#">
                                                <img data-src="{{ $photo->getImage('small') }}" class="swiper-lazy">
                                                <div class="swiper-lazy-preloader"></div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button class="swiper-prev swiper-button-disabled"></button>
                            <button class="swiper-next swiper-button-disabled"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div tabindex="-1" class="modal fade modal-photo jsModalPhoto">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-photo__inner">
                        <a data-dismiss="modal" class="modal-photo__close"></a>
                        <img alt="" class="jsModalPhotoPic">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif