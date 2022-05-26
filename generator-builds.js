document.addEventListener("DOMContentLoaded", function(){
    getBuilds();
})


function getBuilds(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GETuser","controllers/build_controller.php",true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                console.log(this.responseText);
                let list = JSON.parse(this.responseText);
                paintBuilds(list);
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function paintBuilds(list){
    for(var i = 0; i < list.length; i++) {
        console.log(list[i].Image);
        document.getElementById("builds").innerHTML +=`<div class="card">
        <img src="${list[i].Image}" alt="">
        <div>
        <div class="build-infoi">
            <p>Nombre: </p>
            <p class="build-name">${list[i].Name}</p>
        </div>
        <div class="build-infoi">
            <p>precio: </p>
            <p class="build-price">$${list[i].Price}</p>
        </div>
         </div>
         <img onclick="window.location='http://localhost/proyecto/build.php?id=${list[i].id}'" src="assets/icons/eye.svg" alt="" class="i1">
         <img src="assets/icons/pdf.svg" alt="" class="i3">
    </div>`;
    }
}