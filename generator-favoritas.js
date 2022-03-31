document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("favoritas");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="card">
        <img src="assets/cpu.png" alt="" style="cursor: pointer;">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">Intel CPU</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
        <img src="assets/trash.svg" alt="" class="i1">
    </div>`
    }
})