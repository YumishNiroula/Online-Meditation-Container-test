@extends('frontend.layouts.master')
@section('title', 'Forest Meditation')

@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/meditationOne.css') }}" />
@endpush

@section('content')
    <section>
        <div id="home" class="hero-image">
            <div class="hero-video">
                <div class="hero-wo">
                    <img src="{{ asset('frontend/assets/image/tree1.jpeg') }}" alt="" />
                </div>
                <div class="setting-time">
                    @include('frontend.partials.top_left_menu')
                </div>
            </div>
            <br />
            <div class="center-box" style="opacity: 0;">
                <p>Keep calm and just breathe</p>
            </div>

            @include('frontend.partials.set_timer')

            @include('frontend.partials.end_meditation')

            @include('frontend.partials.complete_confirmation')

            <div>
                <audio id="myAudio" loop>
                    <source src="{{ asset('frontend/assets/video/forest.mp3') }}" />
                </audio>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/js/meditationOne.js') }}"></script>
@endpush
