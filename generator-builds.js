document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("builds");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="card">
        <img src="assets/build.png" alt="">
        <div>
        <div class="build-infoi">
            <p>Nombre: </p>
            <p class="build-name">Prueba</p>
        </div>
        <div class="build-infoi">
            <p>precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
         <img src="assets/eye.svg" alt="" class="i1">
         <img src="assets/edit.png" alt="" class="i2">
         <img src="assets/pdf.svg" alt="" class="i3">
    </div>`
    }
})