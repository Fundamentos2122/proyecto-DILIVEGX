document.addEventListener("DOMContentLoaded", function(){
    const builds = document.getElementById("reviews");
    for(var i=0;i<30;i++){
        builds.innerHTML+=`<div class="card">
        <img src="https://picsum.photos/150" alt="">
        <div class="comentario">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis non corrupti harum esse nobis veritatis unde voluptates</p>
        </div>
        <img src="assets/icons/like.svg" alt="" class="i1">
        <p class="like-count">##</p>
        <img src="assets/icons/dislike.svg" alt="" class="i2">
        <p class="dislike-count">##</p>
        <img src="assets/icons/trash.svg" alt="" class="i3">
    </div>`
    }
})