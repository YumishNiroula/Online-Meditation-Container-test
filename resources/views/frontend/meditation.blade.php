{{-- master layout extending --}}
@extends('frontend.layouts.master')
@section('title', 'Online Meditation Environment')

@push('links')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/meditation.css') }}">
@endpush

@section('content')
    <section>
        <div id="home" class="hero-image">
            <div class="hero-video">
                <div class="hero-wo">
                    <img src="{{ asset('frontend/assets/image/meditation.jpg') }}" alt="" />
                </div>
                <div class="title">
                    <span>Online Meditation Environment</span>
                </div>
                <div class="centre-content">
                    <span>Please choose a point to start your meditation (cloud, forest, or lake)</span>
                </div>
                <div class="setting-time">

                    <div class="img-font-box" style="position: relative;margin-top: 30px;">
                        <div>
                        </div>
                    </div>
                    <div class="img-font-box" id="Mute" style="opacity: 1;">
                        <div>
                            <img src="{{ asset('frontend/assets/image/closeAudio.png') }}" alt="" class="start-img"
                                id="myImage">
                        </div>
                        <div class="font-style">
                            <span>Mute</span>
                        </div>
                    </div>
                </div>
                <div class="custom-button" style="top: 30%; left: 10%;">
                    <button onclick="fadeAndRedirect();" class="btn  mt-5 custom-button"
                        style="position: relative;z-index: 999;" id="btn01">O</button>
                </div>
                <div class="custom-button1" style="top: 68%; left: 34%;">
                    <button onclick="fadeAndRedirect1();" class="btn mt-5 custom-button" style="position: relative;"
                        id="btn02">O</button>
                </div>
                <div class="custom-button2" style="top: 22%; left: 46%;">
                    <button onclick="fadeAndRedirect2();" class="btn  mt-5 custom-button" style="position: relative;"
                        id="btn03">O</button>
                </div>
            </div>
            <br>
            <div class="order-box">
                <div>
                    <button class="order-btn btn mt-5" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        User Account
                    </button>
                </div>
                <div>
                    <button class="order-btn btn mt-5" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#examplehistoryRecord">
                        Logs
                    </button>
                </div>
                <div>
                    <button class="order-btn btn mt-5" type="button" data-toggle="modal" data-target="#confirmModal">
                        Log Out
                    </button>
                </div>
            </div>

            @include('frontend.partials.user_profile')

            @include('frontend.partials.log_record')

            @include('frontend.partials.logout')

            <div>
                <audio id="myAudio" loop>
                    <source src="{{ asset('frontend/assets/video/y1972.mp3') }}" />
                </audio>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/js/meditation.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Set desired date format
                autoclose: true, // Close the datepicker when a date is selected
                todayHighlight: true // Highlight today's date
            });
        });
    </script>
@endpush
