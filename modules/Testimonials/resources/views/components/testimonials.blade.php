@props([
    'page' => null,
])

@if ($testimonials->count())
    <section id="testimonials" class="testimonials-section py-5 py-lg-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center mb-5">
                    <h2 class="testimonials-main-title fw-bold mb-3">
                        Trusted by <span class="text-gradient">Industry Leaders</span>
                    </h2>
                    <p class="testimonials-subtitle text-muted">
                        Don't just take our word for it—see what our clients have to say
                    </p>
                </div>
            </div>

            <div class="swiper swiper-testimonials-new">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $index => $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-card-new bg-white shadow-sm h-100">
                                <!-- Avatar e Info do Cliente -->
                                <div class="testimonial-header d-flex align-items-start gap-1 mb-2">
                                    <div
                                        class="testimonial-avatar text-white rounded-circle d-flex align-items-center justify-content-center">
                                        {{ strtoupper(substr($testimonial->text_1 ?? 'U', 0, 2)) }}
                                    </div>
                                    <div class="flex-grow-1">
                                        @if ($testimonial->text_1)
                                            <h4 class="testimonial-name fw-bold mb-1">{{ $testimonial->text_1 }}</h4>
                                        @endif
                                        @if ($testimonial->text_2)
                                            <p class="testimonial-role text-muted mb-0">{{ $testimonial->text_2 }}</p>
                                        @endif
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#51236D" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-quote w-8 h-8 text-primary/20">
                                        <path
                                            d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z">
                                        </path>
                                        <path
                                            d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z">
                                        </path>
                                    </svg>
                                </div>

                                <!-- Rating Stars -->
                                <div class="testimonial-rating d-flex align-items-center gap-0-50 mb-2">
                                    @foreach (range(0, 4) as $star)
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 0L12.2451 7.40983H20.0902L13.9226 11.9803L16.1676 19.3902L10 14.8197L3.83238 19.3902L6.07738 11.9803L-0.0901699 7.40983H7.75486L10 0Z"
                                                fill="#A74259" />
                                        </svg>
                                    @endforeach
                                </div>

                                <!-- Badge de Resultado -->
                                @if ($testimonial->text_4)
                                    <div
                                        class="result-badge d-inline-flex align-items-center gap-2 mb-2 px-2 py-1">
                                        {{-- <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="10" cy="10" r="10" fill="#8B4B9E"/>
                                            <path d="M6 10L9 13L14 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg> --}}
                                        <span class="result-badge-text fw-semibold">
                                            Result: {{ $testimonial->text_4 }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Depoimento -->
                                @if ($testimonial->text_3)
                                    <p class="testimonial-text mb-0">
                                        "{{ $testimonial->text_3 }}"
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows -->
            <div class="testimonials-navigation d-flex justify-content-center gap-3 mt-4">
                <button class="testimonial-nav-btn swiper-button-prev-custom btn rounded-circle border-0 shadow-sm">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="#333" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="testimonial-nav-btn swiper-button-next-custom btn rounded-circle border-0 shadow-sm">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 5L12.5 10L7.5 15" stroke="#333" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endif
