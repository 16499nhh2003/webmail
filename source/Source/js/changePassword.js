let iusername = document.getElementById("username");
let ipasswordOld = document.getElementById("passwordOld");
let ipasswordNew = document.getElementById("passwordNew");
let iconfirmPasswordNew = document.getElementById("confirmPasswordNew");

let username = iusername.value;
let passwordOld = ipasswordOld.value;
let passwordNew = ipasswordNew.value;
let confirmPasswordNew = iconfirmPasswordNew.value;

/// CHECK VALID 
function checkValid(){
    if (username ===  ""){
        msg.innerHTML = "Vui lòng nhập tài khoản";
        iusername.focus();
        return false;
    }
    if ( passwordOld ===  ""){
        msg.innerHTML = "Nhập mật khẩu";
        ipasswordOld.focus();
        return false;
    }
    if (passwordOld.length < 4 || passwordOld.length > 32){
        msg.innerHTML = "Mật khẩu ít nhất 4 kí tự và không được quá  32 ký tự";
        ipasswordOld.focus();
        return false;
    }
    if  (passwordNew === ""){
        msg.innerHTML ="Nhập mật khẩu mới";
        ipasswordNew.focus();
        return false;
    }
    if ( passwordNew.length < 4 || passwordNew.length  > 32){
        msg.innerHTML = "Mật khẩu ít nhất 4 kí tự và không được quá  32 ký tự";
        ipasswordNew.focus();
        return false;
    }
    if  ( confirmPasswordNew === ""){
        msg.innerHTML ="Chưa nhập mật khẩu xác nhận";
        iconfirmPasswordNew.focus();
        return false;
    }
    if( confirmPasswordNew !== passwordNew){
        msg.innerHTML = "Mật khẩu không khớp";
        ipassword.focus();
        return false;
    }
    return true;
}


let submit =  document.getElementById("btnsubmit");
submit.addEventListener("click",(evt)=>{
    if (!checkValid()){
        evt.preventDefault();
    }
    evt.preventDefault();
    // fetch api
    let a = {
        username:document.getElementById("username").value,
        passold:document.getElementById("passwordOld").value,
        passsNew:document.getElementById("passwordNew").value,
    }
    fetch('./api/update-password.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(a)
    })
    .then(res => res.json())
    .then(json => {
        if (json.message === true) {
            alert("Đổi mật khẩu thành công!");
            passwordOld.innerHTML= "";
            passwordNew.innerHTML="";
            confirmPasswordNew.innerHTML ="";
            msg.innerHTML ="";
        }
        else{
            alert("Đổi mật khẩu thất bại! Do tên đăng nhập hoặc mật khẩu không đúng!!");
            msg.innerHTML ="Đổi mật khẩu thất bại! Do tên đăng nhập hoặc mật khẩu không đúng!!";
            passwordOld.innerHTML= "";
            passwordNew.innerHTML="";
            confirmPasswordNew.innerHTML ="";
        }
    })
})


// EYE 
let eye = document.querySelectorAll(".eye")
function changestatus(eye,id){
    let input = document.getElementById(id);
    // console.log("123");
    if (input.getAttribute("type") === "password"){
        input.setAttribute("type","text")
        eye.classList.add("fa-eye");
        eye.classList.remove("fa-eye-slash");
    }
    else{
        input.setAttribute("type","password");
        eye.classList.add("fa-eye-slash");
        eye.classList.remove("fa-eye");
    }
}