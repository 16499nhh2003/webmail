const buttonEdit =  document.getElementById("btn-edit")
const rangeDisplay = document.getElementsByClassName("option")[0];
buttonEdit.addEventListener("click",()=>{
    rangeDisplay.removeAttribute("style")   
})