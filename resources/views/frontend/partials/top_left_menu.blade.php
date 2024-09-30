<div class="img-font-box" style="position: relative">
    <a href="{{ route('frontend.home') }}" style="text-decoration: none;">
        <div>
            <div>
                <img src="{{ asset('frontend/assets/image/home1.png') }}" alt="" width="50px"
                    class="titme-hover" />
            </div>
            <div class="font-style">
                <span>Home</span>
            </div>
        </div>
    </a>
    <div>
        <div>
            <img src="{{ asset('frontend/assets/image/return.png') }}" alt="" class="titme-hover"
                data-toggle="modal" data-target="#confirmModalReturn" />
        </div>
        <div class="font-style">
            <span>End Meditation</span>
        </div>
    </div>
</div>
<div id="container-countdown">
    <div id="count" class="is-hied">
        <p id="countdown"></p>
    </div>
</div>
<div class="img-font-box">
    <div>
        <img src="{{ asset('frontend/assets/image/sttingTime.png') }}" alt="" class="titme-hover"
            data-toggle="modal" data-target="#confirmModal" />
    </div>
    <div class="font-style">
        <span>Set Time</span>
    </div>
</div>
<div class="img-font-box" id="playStop">
    <div>
        <img src="{{ asset('frontend/assets/image/start1.png') }}" alt="" class="start-img" id="playStopImg" />
    </div>
    <div class="font-style">
        <span id="playStopText">Continue</span>
    </div>
</div>
<div class="img-font-box" id="reset">
    <div>
        <img src="{{ asset('frontend/assets/image/reset.png') }}" alt="" class="start-img" />
    </div>
    <div class="font-style">
        <span>Reset</span>
    </div>
</div>
<div class="img-font-box" id="Mute">
    <div>
        <img src="{{ asset('frontend/assets/image/closeAudio.png') }}" alt="" class="start-img"
            id="myImage" />
    </div>
    <div class="font-style">
        <span>Mute</span>
    </div>
</div>
