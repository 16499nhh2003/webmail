const buttons = document.querySelectorAll("button.btn-lock");
function handleClick(button){
    if (button.innerHTML === "Mở tài khoản"){
        button.innerHTML = "Khóa tài khoản"
        button.classList.remove("btn-primary");
        button.classList.add("btn-danger");
    }
    else if(button.innerHTML === "Khóa tài khoản"){
        button.innerHTML = "Mở tài khoản";
        button.classList.remove("btn-danger");
        button.classList.add("btn-primary");
    
    }
}
buttons.forEach((button) => {
    button.addEventListener("click", handleClick.bind(null, button));
});
