var reviews;
var rev = 0;
document.addEventListener("DOMContentLoaded", function(){
    getReviews();
});
function getReviews(){
    let xhttp = new XMLHttpRequest();

    xhttp.open("GETUser",`controllers/review_controller.php`,true);

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4){
            if(this.status === 200){
                reviews = JSON.parse(this.responseText);
                rev=0;
                revs();
            }
            else{
                console.log("Error");
            }
        }
    };

    xhttp.send();

    return [];
}

function revs(){
    
    let xhttp = new XMLHttpRequest();
        xhttp.open("GETcpus",`controllers/part_controller.php?id=${reviews[rev].idParte}`,true);
        
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4){
                if(this.status === 200){
                    let part = JSON.parse(this.responseText);
                    document.getElementById("reviews").innerHTML+=`<div class="card" id="r${reviews[rev].id}">
                        <img src="data:image/jpg;base64,${part.Image}" alt="" onclick="window.location='http://localhost/proyecto/part.php?id=${part.id}'"  style="cursor: pointer;">
                        <div class="comentario">
                            <p>${reviews[rev].Review}</p>
                        </div>
                        <img src="assets/icons/trash.svg" alt="" class="i1" onclick="deleteR(${reviews[rev].id});">
                    </div>`
                    rev ++;
                    if(rev<reviews.length){
                        revs();
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

function deleteR(id){
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
            _method: 'DELETE',
            id: id

        };
        xhttp.send(JSON.stringify(data));
        location.reload();
}