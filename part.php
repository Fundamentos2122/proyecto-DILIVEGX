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

    <p class="revtitle">Reviews</p>
    <div id="reviews"></div>
    <script src="generator-part-reviews.js"></script>

    <div class="newrev">
        <p>Nueva Review</p>
        <textarea name="newreview" id="newrev" cols="100" rows="8"></textarea>
        <button class="btn">Publicar review</button>
    </div>
    

    <div class="info">
        <p>Página creada por: Diego Eugenio Saldívar Narváez</p>
        <p>Materia: Fundamentos Web</p>
    </div>

    <script>

        product = document.getElementsByClassName("product");
        especificaciones = document.getElementsByClassName("especificaciones");


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
                product[0].innerHTML += `<img src="${list.Image}" alt="">
                                        <p>${list.Name}</p>`;

                especificaciones[0].innerHTML +=`<p>${list.Description}</p>
                                                <p class="price">$${list.Price}</p>`
        }

    </script>
</body>
</html> 