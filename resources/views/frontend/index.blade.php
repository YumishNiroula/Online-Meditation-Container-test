@extends('frontend.layouts.master')
@section('title', 'Online Meditation Environment')

@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/index.css') }}" />
@endpush

@section('content')
    <section>
        <div id="home" class="hero-image">
            <div class="hero-video">
                <div class="hero-wo">
                    <!-- <video
                                        autoplay="autoplay"
                                        loop="loop"
                                        muted
                                        defaultMuted
                                        playsinline
                                        id="myVideo"
                                        controls="false">
                                        <source
                                          src="./assets/video/pexels-rostislav-uzunov-7513671.mp4"
                                          type="video/mp4" />
                                      </video> -->
                    <img src="{{ asset('frontend/assets/image/index.jpg') }}" alt="" />
                </div>
            </div>
            <br />
        </div>
        <div class="header">
            <div class="center-box">
                <p>Online Meditation Environment</p>
            </div>
            <a href="{{ route('frontend.login') }}"class="btn custom-button" style="position: relative; z-index: 1000;">
                Register / Login
            </a>
        </div>
        <div class="content" id="textContainer">
            <img src="{{ asset('frontend/assets/image/index_popup.jpg') }}" alt="">
            <div class="text">
                <div>Discover the transformative power of online meditation. Join us on a journey of self-discovery and
                    inner peace from the comfort of your own home. Our guided sessions provide an oasis of calm in the midst
                    of life's chaos, helping you to reduce stress, improve focus, and cultivate mindfulness. Embrace the
                    convenience of online meditation and unlock a world of relaxation at your fingertips.
                </div>

                <div>Let's start this journey together......</div>
            </div>
        </div>
        <div class="footer">
            <p>Online Meditation Environment & 2024</p>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/js/index.js') }}"></script>
@endpush
