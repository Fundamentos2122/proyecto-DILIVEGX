document.addEventListener("DOMContentLoaded", function(){
    getBuilds();
})


function getBuilds(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GETuser","controllers/build_controller.php",true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
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
    var html = '';
    for(var i = 0; i < list.length; i++) {
        html +=`<div class="card">
        <img src="data:image/jpg;base64,${list[i].Image}" alt="">
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
         <img src="assets/icons/trash.svg" alt="" class="i2" onclick="deleteb(${list[i].id})">
    </div>`;
    }
    document.getElementById("builds").innerHTML = html;
}

function deleteb(id){
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "controllers/build_controller.php", true);

    xhttp.setRequestHeader("Content-type", "application/json");

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                if (this.responseText === "Registro borrado") {
                    
                }
            }
            else {
                console.log("Error");
            }
        }
    };
    
    let data = {
        _method: 'DELETE',
        id: id,
    };
    xhttp.send(JSON.stringify(data));
    getBuilds();
}