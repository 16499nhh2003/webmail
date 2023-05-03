let email = document.getElementById("email");
let btnsubmit =  document.getElementById("btnsubmit");
let contentModalBody = document.getElementsByClassName("modal-body")[0];
function checkValid(){
    let emailValid = email.value;
    if(emailValid.length === 0){
        contentModalBody.innerHTML = "Nhập email";
        return false;
    }
    let regUserName =    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!email.value.match(regUserName)){
        contentModalBody.innerHTML = "Vui lòng nhập đúng email";
        return false
    }
}
btnsubmit.addEventListener("click",function(evt){
    if (checkValid()==false){
        evt.preventDefault();
    }
})
