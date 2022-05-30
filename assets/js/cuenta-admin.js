document.addEventListener("DOMContentLoaded", function(){
    getUsers();
    getReviews();
})


//User
function getUsers(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GET","controllers/users_controller.php",true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                let list = JSON.parse(this.responseText);
                paintUsers(list);
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}
function paintUsers(list){
    for(var i = 0; i<list.length;i++)
        if(list[i].Type=="admin")
        document.getElementById("users").innerHTML+=`<div class="item">
        <img src="data:image/jpg;base64,${list[i].Image}" style="width:10em; height: 10em"alt="">
        <p class="name">${list[i].UserName}</p>
        <img class="icon" src="assets/icons/admin.png" alt="">
        </div>`;
        else document.getElementById("users").innerHTML+=`<div class="item">
        <img src="data:image/jpg;base64,${list[i].Image}" style="width:10em; height: 10em"alt="">
        <p class="name">${list[i].UserName}</p>
        <img class="icon" src="assets/icons/trash.svg" alt="" onclick="deletep(${list[i].id})" style="cursor: pointer;">
        <img class="icon" src="assets/icons/account.png" alt="" onclick="admin(${list[i].id})" style="cursor: pointer;">
        </div>`;
}
function deletep(id){
    let xhttp = new XMLHttpRequest();
    xhttp.open("DELETE", "controllers/users_controller.php", true);

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
            id: id
        };
        xhttp.send(JSON.stringify(data));
        location.reload();
}
function admin(id){
    let xhttp = new XMLHttpRequest();
    xhttp.open("ADMIN", "controllers/users_controller.php", true);

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
            id: id
        };
        xhttp.send(JSON.stringify(data));
        location.reload();
}

//Reported reviews
function getReviews(){
    let xhttp = new XMLHttpRequest();
    xhttp.open("GETReported","controllers/review_controller.php",true);
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                let list = JSON.parse(this.responseText);
                paintRevs(list);
            }
            else{
                console.log("Error");
            }
        }
    };
    xhttp.send();
    return [];
}
function paintRevs(list){
    for(var i = 0; i<list.length;i++)
    document.getElementById("revs").innerHTML+=`<div class="review">
    <p class="revtext">${list[i].Review}</p>
    <img class="icon" src="assets/icons/trash.svg" alt="" onclick="deleter(${list[i].id})" style="cursor: pointer;">
    </div>`;
}
function deleter(id){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "controllers/review_controller.php", true);
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
            _method: "DELETE",
            id: id
        };
        xhttp.send(JSON.stringify(data));
        location.reload();
}

var file;
function handleFiles(files){
    file = files[0];
    if(files[0].type=="image/jpeg"){

    }
}
function chequeo(){
    if(document.getElementsByName("name")[0].value=="")
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó un nombre";
    else if(document.getElementsByName("desc")[0].value=="")
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó una descripción";
    else if(document.getElementsByName("price")[0].value=="")
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó un precio";
    else if(document.getElementsByName("brand")[0].value=="")
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó una marca";
    else if((document.getElementsByName("socket")[0].value=="" && document.getElementsByName("types")[0].value=="cpu")||(document.getElementsByName("socket")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó un socket, requerido en CPU o MB";
    else if((document.getElementsByName("ff")[0].value=="" && document.getElementsByName("types")[0].value=="cas")||(document.getElementsByName("ff")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó un factor de forma, requerido en CASE o MB";
    else if((document.getElementsByName("ddr")[0].value=="" && document.getElementsByName("types")[0].value=="ram")||(document.getElementsByName("ddr")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=No se insertó un factor de forma, requerido en RAM o MB";
    else if(!file || file.type!="image/jpeg")
        window.location.href ="http://localhost/proyecto/cuenta-admin.php?error=La imagen es inexistente o no es JPG";
    else{
        return true;
    }

    return false;
}