const container = document.querySelector("#container");
const signInButton = document.querySelector("#signIn");
const signUpButton = document.querySelector("#signUp");

// Get page elements

function signIn() {
  document.getElementById("isShowLogin").style.display = "block";
  document.getElementById("isAccount").style.display = "none";
}
function signUp() {
  document.getElementById("isShowLogin").style.display = "none";
  document.getElementById("isAccount").style.display = "flex";
}
signUpButton.addEventListener("click", () => container.classList.add("right-panel-active"));
// When the user clicks the "Register" button, the panel displays an animation of the "right-panel-active" class.
signInButton.addEventListener("click", () => container.classList.remove("right-panel-active"));
// When the user clicks the "Login" button, the panel hides and removes the "right-panel-active" class.
function register() {
  var emailInput = document.getElementById("emial").value;
  var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (emailPattern.test(emailInput)) {
  } else {
    let content = "Invalid email format";
    modelMsg(content);
    return false;
  }
  var username = document.getElementById("username").value;
  var pwd = document.getElementById("pwd").value;
  var pwds = document.getElementById("pwds").value;
  if (pwd !== pwds) {
    let content = "The passwords are inconsistent. Please re-enter them.";
    modelMsg(content);
    return false;
  }
  const hotArr = [];
  let obj = {
    name: username,
    pwd: pwds,
  };
  let hotUser = JSON.parse(localStorage.getItem("hotUser"));
  if (!hotUser) {
    hotArr.push(obj);
    localStorage.setItem("hotUser", JSON.stringify(hotArr));
  } else {
    hotUser.push(obj);
    localStorage.setItem("hotUser", JSON.stringify(hotUser));
  }
  let content = `Register successfully, username:${username}, password:${pwds}`;
  modelMsg(content);
  return true;
}

function login() {
  var userLogin = document.getElementById("userLogin").value;
  var pwdLogin = document.getElementById("pwdLogin").value;
  let rememberMe = document.getElementById("rememberMe").checked;
  console.log(rememberMe);
  let hotUser = JSON.parse(localStorage.getItem("hotUser"));
  const indexFind = hotUser.findIndex((item) => item.name == userLogin && item.pwd == pwdLogin);
  if (indexFind !== -1) {
    let content = "Login successfully";
    modelMsg(content);
    if (rememberMe) {
      localStorage.setItem("rememberMe", rememberMe);
    }
    // Start page switching gradient effect
    var opacity = 1;
    var interval = setInterval(function () {
      opacity -= 0.05;
      document.body.style.opacity = opacity;
      document.body.style.backgroundColor = "rgba(0, 191, 255, " + opacity + ")";
      if (opacity <= 0) {
        clearInterval(interval);
        // Manually triggered form submission
        document.querySelector("#isShowLogin form").submit();
      }
    }, 60);
    return false; // Blocking default form submission behaviour
  } else {
    let content = "The username or password is incorrect. Please re-enter them.";
    modelMsg(content);
    return false;
  }
}

// Setting the content of the pop-up box
function modelMsg(content) {
  $("#alertMsg").modal("show");
  let text = document.getElementById("alertMsgVal");
  text.textContent = content;
}

document.addEventListener("DOMContentLoaded", function () {
  var opacity = 0;
  var interval = setInterval(function () {
    opacity += 0.05;
    document.body.style.opacity = opacity;
    document.body.style.backgroundColor = "rgba(0, 191, 255, " + opacity + ")";
    if (opacity >= 1) {
      clearInterval(interval);
    }
  }, 60);
});

function returnHome() {
  var opacity = 1;
  var interval = setInterval(function () {
    opacity -= 0.05;
    document.body.style.opacity = opacity;
    document.body.style.backgroundColor = "rgba(0, 191, 255, " + opacity + ")";
    if (opacity <= 0) {
      clearInterval(interval);
      window.location.href = "./index.html";
    }
  }, 60);
}
