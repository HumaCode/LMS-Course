<section class="testimonial-area section-padding">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Testimonials</h5>
            <h2 class="section__title">Student's Feedback</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
    </div><!-- end container -->
    <div class="container-fluid">
        <div class="testimonial-carousel owl-action-styled">

            @foreach ($reviews as $review)
                <div class="card card-item">
                    <div class="card-body">
                        <div class="media media-card align-items-center pb-3">
                            <div class="media-img avatar-md">
                                <img src="{{ !empty($review->user->photo) ? url('upload/user_images/' . $review->user->photo) : url('upload/no_image.jpg') }}"
                                    alt="Testimonial avatar" class="rounded-full">
                            </div>
                            <div class="media-body">
                                <h5>{{ $review->user->name }}</h5>
                                <div class="d-flex align-items-center pt-1">
                                    <div class="review-stars">
                                        @if ($review->rating == null)
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif ($review->rating == 1)
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif ($review->rating == 2)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif ($review->rating == 3)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif ($review->rating == 4)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                        @elseif ($review->rating == 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- end media -->
                        <p class="card-text">
                            {{ $review->comment }}
                        </p>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            @endforeach


        </div><!-- end testimonial-carousel -->
    </div><!-- container-fluid -->
</section>
