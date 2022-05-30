document.addEventListener("DOMContentLoaded", function(){

    getParts("cpu");

})

var list;

var cpu;
var mb;
var ram;
var cas;
var gpu;
var ssd;
var cpc;
var psu;
var fan;
var price=0;
var image;

var socket;
var formfactor;
var ddr;


function getParts(part) {

    let xhttp = new XMLHttpRequest();

    if(part=="cpu")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);
    else if(part=="mb")
        xhttp.open("GETparts",`controllers/part_controller.php?socket=${socket}&type=${part}`,true);
    else if(part=="ram")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}&ddr=${ddr}`,true);
    else if(part=="cas")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}&formfactor=${formfactor}`,true);
    else if(part=="gpu")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);
    else if(part=="ssd")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);
    else if(part=="cpc")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);
    else if(part=="fan")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);
    else if(part=="psu")
        xhttp.open("GETparts",`controllers/part_controller.php?type=${part}`,true);


    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                //console.log(this.responseText);
                list = JSON.parse(this.responseText);
                if(part=="cpu")
                    paintCPUS();
                else if(part=="mb")
                    paintMBS();
                else if(part=="ram")
                    paintRAMS();
                else if(part=="cas")
                    paintCASS();
                else if(part=="gpu")
                    paintGPUS();
                else if(part=="ssd")
                    paintSSDS();
                else if(part=="cpc")
                    paintCPCS();
                else if(part=="fan")
                    paintFANS();
                else if(part=="psu")
                    paintPSUS();
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function paintCPUS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id} >
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="CPUselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("cpu").innerHTML = html;
}


function CPUselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("cpu").style.pointerEvents = "none";
    cpu = selected;
    for(var i = 0; i < list.length; i++)
        if(list[i].id == selected)
            socket = list[i].Socket;
    getParts("mb");
}

function paintMBS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id} >
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="MBselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("mb").innerHTML = html;
}

function MBselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("mb").style.pointerEvents = "none";
    mb = selected;
    for(var i = 0; i < list.length; i++)
        if(list[i].id == selected){
            formfactor = list[i].FormFactor;
            ddr = list[i].Ddr;
        }
    getParts("ram");
}

function paintRAMS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id}>
             <img src="data:image/jpg;base64,${list[i].Image}" alt=""  onclick="RAMselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("ram").innerHTML = html;
}

function RAMselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("ram").style.pointerEvents = "none";
    ram = selected;
    if(formfactor == "MITX"){
        getParts("cas");
        formfactor = "MATX";
        getParts("cas");
        formfactor = "ATX";
        getParts("cas");
    }
    else if(formfactor == "MATX"){
        getParts("cas");
        formfactor = "ATX";
        getParts("cas");
    }
    else 
        getParts("cas");
}

function paintCASS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id}>
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="CASselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("cas").innerHTML += html;
}

function CASselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("cas").style.pointerEvents = "none";
    cas = selected;
    getParts("gpu");
}

function paintGPUS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id}>
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="GPUselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("gpu").innerHTML = html;
}

function GPUselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("gpu").style.pointerEvents = "none";
    gpu = selected;
    getParts("ssd");
}

function paintSSDS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id} >
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="SSDselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("ssd").innerHTML = html;
}

function SSDselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("ssd").style.pointerEvents = "none";
    ssd = selected;
    getParts("cpc");
}

function paintCPCS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id}>
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="CPCselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("cpc").innerHTML = html;
}

function CPCselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("cpc").style.pointerEvents = "none";
    cpc = selected;
    getParts("fan");
}

function paintFANS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id} >
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="FANselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("fan").innerHTML = html;
}

function FANselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("fan").style.pointerEvents = "none";
    fan = selected;
    getParts("psu");
}

function paintPSUS() {

    let html = '';

    for(var i = 0; i < list.length; i++) {
        html +=`<div class="item" id = ${list[i].id} >
             <img src="data:image/jpg;base64,${list[i].Image}" alt="" onclick="PSUselect(${list[i].id})">
             <p class="name" onclick="window.open('http://localhost/proyecto/part.php?id=${list[i].id}')">${list[i].Name}</p>
             <p class="price">$${list[i].Price}</p>
           </div>`;
    }

    document.getElementById("psu").innerHTML = html;
}

function PSUselect(selected){
    document.getElementById(selected).style.backgroundColor = "rgb(114, 21, 201)";
    document.getElementById(selected).style.color = "white";
    document.getElementById("psu").style.pointerEvents = "none";
    psu = selected;

    parts = [cpu, mb, ram, cas, gpu, ssd, cpc, psu, fan];
    console.log(cpu);
        console.log(mb);
            console.log(ram);
                console.log(cas);
                    console.log(gpu);
                        console.log(ssd);
                            console.log(cpc);
                                console.log(psu);
                                    console.log(fan);
                                        console.log(parts);

                                        for(i=0; i < parts.length ; i++){
                                            let xhttp = new XMLHttpRequest();

                                            xhttp.open("GETcpus",`controllers/part_controller.php?id=${parts[i]}`,true);

                                            xhttp.onreadystatechange = function(){
                                                if(this.readyState === 4){
                                                    if(this.status === 200){
                                                        console.log(this.responseText);
                                                        let list = JSON.parse(this.responseText);
                                                        price+=list.Price;
                                                        console.log(price);
                                                    }
                                                    else{
                                                        console.log("Error");
                                                    }
                                                }
                                            };

                                            xhttp.send();
                                        }
                                        
                                        let xhttp = new XMLHttpRequest();

                                            xhttp.open("GETcpus",`controllers/part_controller.php?id=${cas}`,true);

                                            xhttp.onreadystatechange = function(){
                                                if(this.readyState === 4){
                                                    if(this.status === 200){
                                                        let list = JSON.parse(this.responseText);
                                                        image=list.Image;
                                                    }
                                                    else{
                                                        console.log("Error");
                                                    }
                                                }
                                            };

                                            xhttp.send();
                                        

                                        document.getElementById("btns").style.display = "flex"
}




