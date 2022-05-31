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
                            <p class="build-price" id="p${build.id}"></p>
                        </div>
                        </div>
                        <img src="assets/icons/trash.svg" alt="" class="i1" onclick="deletes(${build.id})">
                    </div>
                    `;
                    GetPrice(build);
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

function GetPrice(list){
    //cpu
        var price = 0;
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCPU}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                    printmb();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    function printmb(){
    //mb
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idMB}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printcas();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printcas(){
    //case
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCAS}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printgpu();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printgpu(){
    //gpu
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idGPU}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printssd();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printssd(){
    //ssd
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idSSD}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printcpc();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printcpc(){
    //cpc
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idCPC}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printfan();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printfan(){
    //fan
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idFAN}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                printpsu();
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
    function printpsu(){
    //psu
        let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${list.idPSU}`,true);
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    price+=part.Price;
                    console.log("price="+price);
                    document.getElementById("p"+list.id).innerHTML = "$"+ price;
                }
                else{
                    console.log("Error");
                }
            }
        };
        xhttp.send();
    }
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