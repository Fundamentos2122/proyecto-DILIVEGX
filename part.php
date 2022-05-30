<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="cards.css">
    <link rel="stylesheet" href="part.css">
    <title>Document</title>
</head>
<body onresize="change()">
<?php
include 'assets/header/header.php';
if(array_key_exists("id",$_SESSION))
    echo '<div style="display: flex; gap: 1em; margin: 1em; align-items: center;">
                <img id="favorite" src="assets/icons/star.svg" alt="" style="width:1.5em; cursor: pointer;" onclick="favorite();">
                <p>Favorita</p>
          </div>';
?>



    <div class="product">
        
    </div>

<div class="product-info">

    <div class="graphics">
        <img src="assets/icons/g1.png" alt="">
        <img src="assets/icons/g2.png" alt="">
    </div>

    <div class="especificaciones">
        
    </div>
</div>
<?php
if(array_key_exists("id",$_SESSION))
    echo '<div class="newrev">
                <p>Nueva Review</p>
                <textarea name="newreview" id="newrev" cols="100" rows="8"></textarea>
                <button class="btn" id="post" style="cursor: pointer;">Publicar review</button>
            </div>';
?>
    

    <p class="revtitle">Reviews</p>
    <div id="reviews"></div>


    

    <div class="info" >
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>

    <script>
        var reviews;
        var rev = 0;
        var cfavorite = false;
        const builds = document.getElementById("reviews");
        product = document.getElementsByClassName("product");
        especificaciones = document.getElementsByClassName("especificaciones");
        var id;

        document.addEventListener("DOMContentLoaded", function(){
            getPart();
        });

        function checkFavorite(){
            let xhttp = new XMLHttpRequest();

            xhttp.open("GET",`controllers/favorite_parts_controller.php?idPart=${id}`,true);

            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let check = JSON.parse(this.responseText);
                        cfavorite = check;
                        if(check==true)
                            document.getElementById("favorite").src = "assets/icons/star-filled.svg";
                        else if (check==false)
                            document.getElementById("favorite").src = "assets/icons/star.svg";
                    }
                    else{
                        console.log("Error");
                    }
                }
            };

            xhttp.send();

            return [];
        }

        function favorite(){
            if(cfavorite == false){
            let xhttp = new XMLHttpRequest();

            xhttp.open("POST", "controllers/favorite_parts_controller.php", true);

            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        if (this.responseText === "Registro guardado") {
                            checkFavorite()
                        }
                    }
                    else {
                        console.log("Error");
                    }
                }
            };

            let data = {
                _method: 'POST',
                idPart: id
            };
            xhttp.send(JSON.stringify(data));
            } else if(cfavorite == true){
                let xhttp = new XMLHttpRequest();

                xhttp.open("POST", "controllers/favorite_parts_controller.php", true);

                xhttp.setRequestHeader("Content-type", "application/json");

                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        if (this.status === 200) {
                            if (this.responseText === "Registro borrado") {
                                checkFavorite()
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
        }



        function getPart() {

            let xhttp = new XMLHttpRequest();

            xhttp.open("GETcpus","controllers/part_controller.php?id=<?php echo $_GET['id'];?>",true);

            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let list = JSON.parse(this.responseText);
                        paintPart(list);
                        getReviews(list.id);
                        id = list.id;
                        if(<?php
                        if(array_key_exists("id",$_SESSION))
                            echo json_encode(true);
                        else
                            echo json_encode(false);
                        ?> == true)
                        checkFavorite();
                    }
                    else{
                        console.log("Error");
                    }
                }
            };

            xhttp.send();

            return [];
        }

        function paintPart(list) {
                product[0].innerHTML += `<img src="data:image/jpg;base64,${list.Image}" alt="">
                                        <p>${list.Name}</p>`;
                especificaciones[0].innerHTML +=`<p>${list.Description}</p>
                                                <p class="price">$${list.Price}</p>`
        }

        function getReviews(id){
            let xhttp = new XMLHttpRequest();

            xhttp.open("GETPart",`controllers/review_controller.php?id=${id}`,true);

            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        let list = JSON.parse(this.responseText);
                        reviews = list;
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
                xhttp.open("GETuser",`controllers/users_controller.php?id=${reviews[rev].idAutor}`,true);
                xhttp.onreadystatechange = function(){
                    if(this.readyState === 4){
                        if(this.status === 200){
                            let profile = JSON.parse(this.responseText);
                            if(reviews[rev].CantReport==0)
                                builds.innerHTML+=`
                                    <div class="card">
                                    <img src="data:image/jpg;base64,${profile.Image}" alt="">
                                    <div class="comentario">
                                        <p>${reviews[rev].Review}</p>
                                    </div>
                                    <img id="l${reviews[rev].id}" src="assets/icons/like.png" alt="" class="i1" onclick="like(${reviews[rev].id});">
                                    <p class="like-count" id="lc${reviews[rev].id}">${reviews[rev].CantLikes}</p>
                                    <img id="d${reviews[rev].id}" src="assets/icons/dislike.png" alt="" class="i2" onclick="dislike(${reviews[rev].id});">
                                    <p class="dislike-count" id="dc${reviews[rev].id}">${reviews[rev].CantDisLikes}</p>
                                    <img id="r${reviews[rev].id}" src="assets/icons/report.svg" alt="" class="i3" onclick="report(${reviews[rev].id});">
                                    </div>`
                            else if(reviews[rev].CantReport>0)
                                builds.innerHTML+=`
                                    <div class="card">
                                    <img src="data:image/jpg;base64,${profile.Image}" alt="">
                                    <div class="comentario">
                                        <p>${reviews[rev].Review}</p>
                                    </div>
                                    <img id="l${reviews[rev].id}" src="assets/icons/like.png" alt="" class="i1" onclick="like(${reviews[rev].id});">
                                    <p class="like-count" id="lc${reviews[rev].id}">${reviews[rev].CantLikes}</p>
                                    <img id="d${reviews[rev].id}" src="assets/icons/dislike.png" alt="" class="i2" onclick="dislike(${reviews[rev].id});">
                                    <p class="dislike-count" id="dc${reviews[rev].id}">${reviews[rev].CantDisLikes}</p>
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

        function report(idrev){

        let xhttp = new XMLHttpRequest();

        xhttp.open("POSTR", "controllers/review_controller.php", true);

        xhttp.setRequestHeader("Content-type", "application/json");

        xhttp.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    if (this.responseText === "Registro guardado") {
                    }
                }
                else {
                    console.log("Error");
                }
            }
        };
        let data = {
            _method: 'PUT',
            id: idrev
        };
        xhttp.send(JSON.stringify(data));

        document.getElementById(`r${idrev}`).style.display = "none";

        }

        function like(idrev){

            let xhttp = new XMLHttpRequest();

            xhttp.open("POSTL", "controllers/review_controller.php", true);

            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        if (this.responseText === "Registro guardado") {
                        }
                    }
                    else {
                        console.log("Error");
                    }
                }
            };
            let data = {
                _method: 'PUT',
                id: idrev
            };
            xhttp.send(JSON.stringify(data));

            document.getElementById(`l${idrev}`).style.pointerEvents = "none";
            document.getElementById(`d${idrev}`).style.pointerEvents = "none";
            document.getElementById(`l${idrev}`).src = "assets/icons/likef.png";
            document.getElementById(`lc${idrev}`).innerHTML = parseInt(document.getElementById(`lc${idrev}`).innerHTML)+1;
        }

        function dislike(idrev){

            let xhttp = new XMLHttpRequest();

            xhttp.open("POSTD", "controllers/review_controller.php", true);

            xhttp.setRequestHeader("Content-type", "application/json");

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        if (this.responseText === "Registro guardado") {
                        }
                    }
                    else {
                        console.log("Error");
                    }
                }
            };
            let data = {
                _method: 'PUT',
                id: idrev
            };
            xhttp.send(JSON.stringify(data));

            document.getElementById(`l${idrev}`).style.pointerEvents = "none";
            document.getElementById(`d${idrev}`).style.pointerEvents = "none";
            document.getElementById(`d${idrev}`).src = "assets/icons/dislikef.png";
            document.getElementById(`dc${idrev}`).innerHTML = parseInt(document.getElementById(`dc${idrev}`).innerHTML)+1;
        }


        document.getElementById("post").onclick = function(){
            var review = document.getElementById("newrev").value;
            document.getElementById("newrev").value = "";
            let xhttp = new XMLHttpRequest();
                        xhttp.open("POST", "controllers/review_controller.php", true);

                        xhttp.setRequestHeader("Content-type", "application/json");

                        xhttp.onreadystatechange = function() {
                            if (this.readyState === 4) {
                                if (this.status === 200) {
                                    if (this.responseText === "Registro guardado") {
                                        getReviews();
                                    }
                                }
                                else {
                                    console.log("Error");
                                }
                            }
                        };
                        let data = {
                            _method: 'POST',
                            idParte: id,
                            Review: review
                        };
                        xhttp.send(JSON.stringify(data));
                        location.reload();
        };
    </script>
</body>
</html> 