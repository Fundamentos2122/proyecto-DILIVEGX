document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("busqueda");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="card" style="cursor: pointer;">
        <img src="assets/icons/cpu.png" alt="">
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
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/case.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">NZXT Case</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/cooler.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">NZXT Cooler</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/fan.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">Noctua</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/gpu.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">EVGA 3080Ti</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/hdd.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">Segate 1TB</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/mb.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">Gigabyte b450</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/psu.webp" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">Asus Thor 850W</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <img src="assets/icons/ssd.png" alt="">
        <div>
        <div class="build-info">
            <p class="build-name">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="build-name">SanDisk 256GB</p>
        </div>
        <div class="build-info">
            <p>Precio: </p>
            <p class="build-price">$####</p>
        </div>
         </div>
    </div>`
    }
})