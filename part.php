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
    <div class="newrev">
        <p>Nueva Review</p>
        <textarea name="newreview" id="newrev" cols="100" rows="8"></textarea>
        <button class="btn" id="post">Publicar review</button>
    </div>

    <p class="revtitle">Reviews</p>
    <div id="reviews"></div>


    

    <div class="info">
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>

    <script>
        product = document.getElementsByClassName("product");
        especificaciones = document.getElementsByClassName("especificaciones");
        var id;

        document.addEventListener("DOMContentLoaded", function(){
            getPart();
        });



        function getPart() {

            let xhttp = new XMLHttpRequest();

            xhttp.open("GETcpus","controllers/part_controller.php?id=<?php echo $_GET['id'];?>",true);

            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        console.log(this.responseText);
                        let list = JSON.parse(this.responseText);
                        paintPart(list);
                        getReviews(list.id);
                        id = list.id;
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
                console.log(list.Image);
                especificaciones[0].innerHTML +=`<p>${list.Description}</p>
                                                <p class="price">$${list.Price}</p>`
        }

        function getReviews(id){
            let xhttp = new XMLHttpRequest();

            xhttp.open("GETPart",`controllers/review_controller.php?id=${id}`,true);

            xhttp.onreadystatechange = function(){
                if(this.readyState === 4){
                    if(this.status === 200){
                        console.log(this.responseText);
                        let list = JSON.parse(this.responseText);
                        paintReviews(list);
                    }
                    else{
                        console.log("Error");
                    }
                }
            };

            xhttp.send();

            return [];
        }

        function paintReviews(list) {
            const builds = document.getElementById("reviews");
            for(var i=0;i<list.length;i++){
                builds.innerHTML+=`<div class="card">
                <img src="https://picsum.photos/150" alt="">
                <div class="comentario">
                    <p>${list[i].Review}</p>
                </div>
                <img src="assets/icons/like.svg" alt="" class="i1">
                <p class="like-count">${list[i].CantLikes}</p>
                <img src="assets/icons/dislike.svg" alt="" class="i2">
                <p class="dislike-count">${list[i].CantDisLikes}</p>
            </div>`
            }
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
                        

        };
    </script>
</body>
</html> 