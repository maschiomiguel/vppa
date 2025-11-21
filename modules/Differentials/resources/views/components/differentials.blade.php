@props([
    'page' => null,
])

@if ($differentialsSection->count())
    <section class="py-5 differentials" id="differentials">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title fw-bold mb-1 animate-on-scroll" data-animation="fade-up">
                    Our <span class="text-gradient">Process</span>
                </h2>
                <p class="section-subtitle text-muted animate-on-scroll" data-animation="fade-up" data-delay="100">
                    Complete Instagram performance solutions tailored to your brand
                </p>
            </div>

            <div class="row g-2">
                @foreach ($differentialsSection as $index => $differential)
                    <div class="col-md-6 col-lg-3">
                        <div class="differential-card h-100 p-1 p-xxl-2 rounded-4 bg-white border d-flex flex-column animate-on-scroll" data-animation="fade-up" data-delay="{{ ($index + 1) * 100 }}">
                            <div class="flex-grow-1">
                                @if ($differential->image()->count())
                                    <div class="differential-icon mb-1">
                                        <div class="icon-wrapper rounded-3 d-inline-flex align-items-center justify-content-center">
                                            <img src="{{ $differential->image()->first()->url() }}"
                                                alt="{{ $differential->text_1 }}" 
                                                title="{{ $differential->text_1 }}"
                                                class="img-fluid" 
                                                style="max-width: 48px; max-height: 48px;">
                                        </div>
                                    </div>
                                @endif
                                <h3 class="differential-title h5 fw-bold mb-1 text-dark">
                                    {{ $differential->text_1 }}
                                </h3>
                                <p class="differential-description mb-0 text-muted">
                                    {{ $differential->text_2 }}
                                </p>
                            </div>
                            <div class="differential-number text-center mt-3">
                                <span class="differential-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const animateElements = document.querySelectorAll('.animate-on-scroll');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const delay = entry.target.dataset.delay || 0;
                            setTimeout(() => {
                                entry.target.classList.add('animated');
                            }, delay);
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                animateElements.forEach(element => {
                    observer.observe(element);
                });
            });
        </script>
    @endpush
@endif
