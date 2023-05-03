const a =  document.getElementById("position-item")
let i=0
a.addEventListener("click",()=>{
    if (i%2===0){
        document.getElementsByClassName("fa-solid fa-arrow-left")[0].remove();
        let newElement = document.createElement('i');
        newElement.classList.add("fa-solid","fa-arrow-down")
        a.appendChild(newElement)
        console.log(a);
        // a.appendChild(`<i style="float: right;margin-top: 10px;" class="fa-solid fa-arrow-left"></i>`)
    }
    else{
        document.getElementsByClassName("fa-solid fa-arrow-down")[0].remove();
        let newElement = document.createElement('i');
        newElement.classList.add("fa-solid","fa-arrow-left")
        a.appendChild(newElement)
        console.log(a);
    }
    i++;
})