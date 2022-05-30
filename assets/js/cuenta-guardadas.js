document.addEventListener("DOMContentLoaded", function(){
    getSaved();
})

var saved;
var sav = 0;

function getSaved(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GET",`controllers/saved_builds_controller.php`,true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                saved = JSON.parse(this.responseText);
                sav=0;
                savs();
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function savs(){
    
    let xhttp = new XMLHttpRequest();
        xhttp.open("GET",`controllers/build_controller.php?id=${saved[sav].idBuild}`,true);
        
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let build = JSON.parse(this.responseText);
                    document.getElementById("guardadas").innerHTML+=`
                    <div class="card">
                        <img src="data:image/jpg;base64,${build.Image}" alt="" onclick="window.location='http://localhost/proyecto/build.php?id=${build.id}'" style="cursor: pointer;">
                        <div>
                        <div class="build-info">
                            <p>Nombre: </p>
                            <p class="build-name">${build.Name}</p>
                        </div>
                        <div class="build-info">
                            <p>precio: </p>
                            <p class="build-price">$${build.Price}</p>
                        </div>
                        </div>
                        <img src="assets/icons/trash.svg" alt="" class="i1" onclick="deletes(${build.id})">
                    </div>
                    `
                    sav ++;
                    if(sav<saved.length){
                        savs();
                    }
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
        return [];
}

function deletes(id){
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "controllers/saved_builds_controller.php", true);

    xhttp.setRequestHeader("Content-type", "application/json");

    xhttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            if (this.status === 200) {
                if (this.responseText === "Registro borrado") {
                    location.reload();
                }
            }
            else {
                console.log("Error");
            }
        }
    };

    let data = {
        _method: 'DELETE',
        idBuild: id
    };
    xhttp.send(JSON.stringify(data));
}