document.addEventListener("DOMContentLoaded", function () {
    var opacity = 0;
    var interval = setInterval(function () {
        opacity += 0.05; // 每次增加0.1
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(500, 0, 0, " + opacity + ")";
        if (opacity >= 1) {
            clearInterval(interval); // 清除定时器
        }
    }, 60); // 每50毫秒执行一次
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
function returnHome() {
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05; // 每次减小0.1
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(300, 0 , 0, " + opacity + ")";
        if (opacity <= 0) {
            clearInterval(interval); // 清除定时器
            window.location.href = "./main.html";
        }
    }, 60); // 每50毫秒执行一次
}

var urlParams = new URLSearchParams(window.location.search);
var param = urlParams.get("params");

// 操作时间
let timerID;
let amountTimer = parseInt(localStorage.getItem("amountTime"));
var timer = localStorage.getItem("timer");
var amountTime = null;
if (param == "main") {
    amountTime = timer * 60;
} else if (param == "meditation") {
    amountTime = amountTimer;
    if (timer && amountTimer) {
        timerID = setInterval(timerS, 1000);
    }
} else {
    amountTime = timer * 60;
}

const audio = document.querySelector("#myAudio");
const buttonPlay = document.querySelector("#play");
const reset = document.querySelector("#reset");
// // 开始
// buttonPlay.addEventListener("click", function () {
//   if (!timer) {
//     let content = "Please set a meditation time";
//     modelMsg(content);
//     return false;
//   }
//   timerID = setInterval(timerS, 1000);
//   audio.play();
//   document.getElementById("count").classList.add("is-hied");
// });

// // 暂停
// const buttonStop = document.querySelector("#stop");
// buttonStop.addEventListener("click", function () {
//   stopTimer();
// });
// 静音开/关
const Mute = document.getElementById("Mute");
var image = document.getElementById("myImage");
Mute.addEventListener("click", function () {
    if (image.src.match("frontend/assets/image/closeAudio.png")) {
        image.src = "frontend/assets/image/openAudio.png";
        audio.play();
    } else {
        image.src = "frontend/assets/image/closeAudio.png";
        audio.pause();
    }
});
// // 重置
// reset.addEventListener("click", function () {
//   const countdown = document.querySelector("#countdown");
//   amountTime = timer * 60;
//   let minutes = Math.floor(amountTime / 60);
//   let seconds = amountTime % 60;
//   if (seconds < 10) {
//     seconds = "0" + seconds;
//   }
//   countdown.textContent = `${minutes} : ${seconds}`;
//   setTimeout(() => {
//     stopTimer();
//   }, 500);
// });

function timerS() {
    const countdown = document.querySelector("#countdown");
    let minutes = Math.floor(amountTime / 60);
    let seconds = amountTime % 60;

    if (seconds < 10) {
        seconds = "0" + seconds;
    }

    countdown.textContent = `${minutes} : ${seconds}`;
    amountTime--;

    if (amountTime < 0) {
        amountTime = 0;
        let content = "It's time for your meditation";
        modelMsg(content);
        stopTimer();
        return false;
    }
}

function stopTimer() {
    clearInterval(timerID);
    audio.pause();
}

function setTime() {
    $("#successAlert").removeClass("d-none").alert();
    let tval = document.getElementById("timeValue").value;
    if (!tval) {
        $("#confirmModal").modal("hide");
        let content = "Please set a meditation times";
        modelMsg(content);
        return false;
    }
    timer = parseInt(document.getElementById("timeValue").value);
    localStorage.setItem("timer", parseInt(tval));
    const countdown = document.querySelector("#countdown");
    amountTime = timer * 60;
    let minutes = Math.floor(amountTime / 60);
    let seconds = amountTime % 60;
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    countdown.textContent = `${minutes} : ${seconds}`;
    stopTimer();
    let content = `Set the meditation time to  ${timer}min`;
    modelMsg(content);
    $("#confirmModal").modal("hide");
    $(".is-hied").removeClass("is-hied");
}
function changeImage() {
    var audio = document.getElementById("myAudio");
    var image = document.getElementById("myImage");
    if (image.src.match("frontend/assets/image/closeAudio.png")) {
        image.src = "frontend/assets/image/openAudio.png";
        audio.play();
    } else {
        image.src = "frontend/assets/image/closeAudio.png";
        audio.pause();
    }
}

function fadeAndRedirect() {
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05; // 每次减小0.1
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(500, 0 , 0, " + opacity + ")"; // 使用 rgba() 设置背景颜色，并根据 opacity 改变透明度
        if (opacity <= 0) {
            clearInterval(interval); // 清除定时器
            localStorage.setItem("amountTime", parseInt(amountTime));
            window.location.href = "./meditationOne"; // 跳转到指定页面
        }
    }, 60); // 每50毫秒执行一次
}
function fadeAndRedirect1() {
    // 添加渐变效果
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05; // 每次减小0.1
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(500, 0 , 0, " + opacity + ")";
        if (opacity <= 0) {
            clearInterval(interval); // 清除定时器
            localStorage.setItem("amountTime", parseInt(amountTime));
            window.location.href = "./meditationTwo"; // 跳转到指定页面
        }
    }, 60); // 每50毫秒执行一次
}
function fadeAndRedirect2() {
    // 添加渐变效果
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05; // 每次减小0.1
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(500, 0 , 0, " + opacity + ")";
        if (opacity <= 0) {
            clearInterval(interval); // 清除定时器
            localStorage.setItem("amountTime", parseInt(amountTime));
            window.location.href = "./meditationThree"; // 跳转到指定页面
        }
    }, 60); // 每50毫秒执行一次
}
function loginOut() {
    localStorage.removeItem("rememberMe");
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05;
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(300, 0 , 0, " + opacity + ")";
        if (opacity <= 0) {
            clearInterval(interval);
            window.location.href = "./signin";
        }
    }, 60);
}
