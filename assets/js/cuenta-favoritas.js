document.addEventListener("DOMContentLoaded", function(){
    getFavorites();
})

var favorites;
var fav = 0;

function getFavorites(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GET",`controllers/favorite_parts_controller.php`,true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                favorites = JSON.parse(this.responseText);
                fav=0;
                favs();
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function favs(){
    
    let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${favorites[fav].idPart}`,true);
        
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    document.getElementById("favoritas").innerHTML+=`
                    <div class="card">
                        <img src="data:image/jpg;base64,${part.Image}" alt="" style="cursor: pointer;" onclick="window.location='http://localhost/proyecto/part.php?id=${part.id}'">
                        <div>
                        <div class="build-info">
                            <p class="build-name">${part.Name}</p>
                            <p class="build-name">${part.Brand} ${part.Type}</p>
                        </div>
                        <div class="build-info">
                            <p>Precio: </p>
                            <p class="build-price">$${part.Price}</p>
                        </div>
                        </div>
                        <img src="assets/icons/trash.svg" alt="" class="i1" onclick="deletef(${part.id})">
                    </div>
                    `
                    fav ++;
                    if(fav<favorites.length){
                        favs();
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

function deletef(id){
    let xhttp = new XMLHttpRequest();

    xhttp.open("POST", "controllers/favorite_parts_controller.php", true);

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
        idPart: id
    };
    xhttp.send(JSON.stringify(data));
}