Buildlist = document.getElementById("builds");
CPUlist = document.getElementById("cpus");
GPUlist = document.getElementById("gpus");



document.addEventListener("DOMContentLoaded", function(){
    getBuilds();
    getCpus();
    getGpus();
});

function getBuilds(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GET","controllers/build_controller.php",true);

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
    for(var i = 0; i < 28; i++) {
        if(list[i])
        document.getElementById("builds").innerHTML +=`<div class="item"><a href="http://localhost/proyecto/build.php?id=${list[i].id}"><img src="data:image/jpg;base64,${list[i].Image}" alt="" class="item-img"><p class="indextxt">${list[i].Name}</p></a></div>`;
    }
}

function getCpus() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("GETcpus","controllers/part_controller.php",true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                let list = JSON.parse(this.responseText);
                paintCpus(list);
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function paintCpus(list) {
    let html = '';

    for(var i = 0; i < 22; i++) {
        if(list[i])
        html +=`<div class="item"><a href="part.php?id=${list[i].id}"><img src="data:image/jpg;base64,${list[i].Image}" alt="" class="item-img"><p class="indextxt">${list[i].Name}</p></a></div>`;
    }
    
    

    CPUlist.innerHTML += html; 
}

function getGpus() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("GETgpus","controllers/part_controller.php",true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                let list = JSON.parse(this.responseText);
                paintGpus(list);
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function paintGpus(list) {

    let html = '';

    for(var i = 0; i < 22; i++) {
        if(list[i])
        html +=`<div class="item"><a href="part.php?id=${list[i].id}"><img src="data:image/jpg;base64,${list[i].Image}" alt="" class="item-img"><p class="indextxt">${list[i].Name}</p></a></div>`;
    }

    GPUlist.innerHTML += html; 
}


