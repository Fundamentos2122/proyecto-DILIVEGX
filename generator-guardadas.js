document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("guardadas");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="card">
        <img src="assets/build.png" alt="">
        <div>
        <div class="build-info">
            <p>Nombre: </p>
            <p class="build-name">Prueba</p>
        </div>
        <div class="build-info">
            <p>precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
        <img src="assets/trash.svg" alt="" class="i1">
        <img src="assets/pdf.svg" alt="" class="i3">
    </div>`
    }
})