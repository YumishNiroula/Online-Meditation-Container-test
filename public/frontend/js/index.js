document.addEventListener("DOMContentLoaded", function () {
    var opacity = 0;
    var interval = setInterval(function () {
        opacity += 0.05;
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(0, 0 , 128, " + opacity + ")";
        if (opacity >= 1) {
            clearInterval(interval);
        }
    }, 60);
});
window.onload = function () {
    adjustTextSize();
};

function adjustTextSize() {
    var textContainer = document.getElementById("textContainer");
    var fontSize = parseFloat(window.getComputedStyle(textContainer).fontSize);
    var containerWidth = textContainer.clientWidth;
    var textWidth = textContainer.scrollWidth;

    while (textWidth > containerWidth && fontSize > 0) {
        fontSize -= 1;
        textContainer.style.fontSize = fontSize + "px";
        textWidth = textContainer.scrollWidth;
    }
}
// 获取图片元素和文本元素
var img = document.querySelector(".content img");
var text = document.querySelector(".content .text");

// 设置文本元素的高度和宽度与图片元素相同
function updateTextSize() {
    text.style.height = img.offsetHeight + "px";
    text.style.width = img.offsetWidth + "px";
}
// 初始加载时设置大小
updateTextSize();
// 窗口大小改变时重新设置大小
window.addEventListener("resize", updateTextSize);
function fadeAndRedirect() {
    var opacity = 1;
    var interval = setInterval(function () {
        opacity -= 0.05;
        document.body.style.opacity = opacity;
        document.body.style.backgroundColor =
            "rgba(0, 0 , 128, " + opacity + ")";
        if (opacity <= 0) {
            clearInterval(interval);
            var rememberMe = localStorage.getItem("rememberMe");
            if (rememberMe === "true") {
                window.location.href = "./home";
            } else {
                window.location.href = "./signin";
            }
        }
    }, 60);
}
