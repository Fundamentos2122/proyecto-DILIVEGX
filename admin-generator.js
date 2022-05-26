document.addEventListener("DOMContentLoaded", function(){
    
    for(var i=0;i<30;i++)
        document.getElementById("users").innerHTML+=`<div class="item">
        <img src="https://picsum.photos/150" alt="">
        <p class="name">(Nombre del usuario)</p>
        <img class="icon" src="assets/icons/trash.svg" alt="">
        </div>`;
    for(var i=0;i<30;i++)
        document.getElementById("revs").innerHTML+=`<div class="review">
        <p class="revtext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, nam? Ipsa perferendis unde fugiat cum sit ipsam ad. Hic quam cumque nemo rem illum quos sint...</p>
        <img class="icon" src="assets/icons/trash.svg" alt="">
        </div>`;
        
})