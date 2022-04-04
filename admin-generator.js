document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("users");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="item">
        <img src="https://picsum.photos/150" alt="">
        <p class="name">(Nombre del usuario)</p>
        <img class="icon" src="assets/trash.svg" alt="">
    </div>`
    }
})