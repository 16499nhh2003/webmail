let eye = document.querySelectorAll(".eye");
function changestatus(eye, id) {
  let input = document.getElementById(id);
  if (input.getAttribute("type") === "password") {
    input.setAttribute("type", "text");
    eye.classList.add("fa-eye");
    eye.classList.remove("fa-eye-slash");
  } else {
    input.setAttribute("type", "password");
    eye.classList.add("fa-eye-slash");
    eye.classList.remove("fa-eye");
  }
}
let btsubmit = document.getElementById("btnsubmit");
let iname = document.getElementById("name");
let iemail = document.getElementById("email");
let idob = document.getElementById("dob");
let iusername = document.getElementById("username");
let ipassword = document.getElementById("password");
let iconfirmPassword = document.getElementById("confirmPassword");
let message = document.getElementById("msg");

btsubmit.addEventListener("click", (evt) => {
  if (checkValid() == false) {
    evt.preventDefault();
  }
  // fetch api
  else{

  }
});

function isValidDate(dateString) {
  // Ensure the input matches the expected format
  const regex = /^\d{4}-\d{2}-\d{2}$/;
  if (!regex.test(dateString)) {
    return false;
  }

  // Extract the year, month, and day from the input
  const year = parseInt(dateString.slice(0, 4));
  const month = parseInt(dateString.slice(5, 7)) - 1; // Subtract 1 to compensate for 0-indexed months
  const day = parseInt(dateString.slice(8, 10));

  // Create a new Date object with the extracted values and check if the resulting date is valid
  const date = new Date(year, month, day);
  return (
    date.getFullYear() === year &&
    date.getMonth() === month &&
    date.getDate() === day
  );
}

function checkValid() {
  let name = iname.value;
  let email = iemail.value;
  let password = ipassword.value;
  let dob = idob.value;
  let msg = document.getElementById("msg");
  let confirmPassword = iconfirmPassword.value;
  let username = iusername.value;
  msg.style.color = "red";
  if (name === "") {
    msg.innerHTML = "Nhập tên";
    iname.focus();
    return false;
  }
  let nameVN = deleteDauVN(name);
  let regName = /^[a-z ]+$/i;
  if (!nameVN.match(regName)) {
    msg.innerHTML = "Tên không hợp lệ";
    iname.focus();
    return false;
  }

  if (!isValidDate(dob)) {
    msg.innerHTML = "Ngày sinh không hợp lệ";
    idob.focus();
    return false;
  }

  if (email === "") {
    msg.innerHTML = "Email Không được bỏ trống";
    iemail.focus();
    return false;
  }
  let regEmail =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!email.match(regEmail)) {
    msg.innerHTML = "Email không hợp lệ";
    iemail.focus();
    return false;
  }
  if (username === "") {
    msg.innerHTML = "Tên đăng nhập không được bỏ trống!";
    iusername.focus();
    return false;
  }
  if (password === "") {
    msg.innerHTML = "Nhập mật khẩu";
    ipassword.focus();
    return false;
  }
  if (password.length < 4 || password.length > 32) {
    msg.innerHTML = "Mật khẩu ít nhất 4 kí tự và không được quá  32 ký tự";
    ipassword.focus();
    return false;
  }
  if (confirmPassword === "") {
    msg.innerHTML = "Chưa nhập mật khẩu xác nhận";
    iconfirmPassword.focus();
    return false;
  }
  if (confirmPassword !== password) {
    msg.innerHTML = "Mật khẩu không khớp";
    ipassword.focus();
    return false;
  }
  return true;
}
function deleteDauVN(str) {
  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
  str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
  str = str.replace(/đ/g, "d");
  str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
  str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
  str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
  str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
  str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
  str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
  str = str.replace(/Đ/g, "D");
  return str;
}
