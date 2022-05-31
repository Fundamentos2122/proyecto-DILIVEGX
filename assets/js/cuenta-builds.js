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
            <p class="build-price" id="p${list[i].id}"></p>
        </div>
         </div>
         <img onclick="window.location='http://localhost/proyecto/build.php?id=${list[i].id}'" src="assets/icons/eye.svg" alt="" class="i1">
         <img src="assets/icons/trash.svg" alt="" class="i2" onclick="deleteb(${list[i].id})">
    </div>`;
    GetPrice(list[i]);
    }
    document.getElementById("builds").innerHTML = html;
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