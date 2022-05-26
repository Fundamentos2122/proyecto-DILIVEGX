CPUlist = document.getElementById("cpus");
GPUlist = document.getElementById("gpus");



document.addEventListener("DOMContentLoaded", function(){
    getCpus();
    getGpus();
});



function getCpus() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("GETcpus","controllers/part_controller.php",true);//Se le puso esto

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                console.log(this.responseText);
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

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item"><a href="part.php?id=${list[i].id}"><img src="${list[i].Image}" alt="" class="item-img"><p>${list[i].Name}</p></a></div>`;
    }

    CPUlist.innerHTML += html; //Le mueves
}

function getGpus() {

    let xhttp = new XMLHttpRequest();

    xhttp.open("GETgpus","controllers/part_controller.php",true);//Se le puso esto

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                console.log(this.responseText);
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

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item"><a href="part.php?id=${list[i].id}"><img src="${list[i].Image}" alt="" class="item-img"><p>${list[i].Name}</p></a></div>`;
    }

    GPUlist.innerHTML += html; //Le mueves
}


