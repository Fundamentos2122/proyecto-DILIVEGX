function sb_open(){
    document.getElementById("sidebar").style.display = "block";
}

function sb_close(){
    document.getElementById("sidebar").style.display = "none";
}


function change(){
    if(document.body.clientWidth>941){
        document.getElementById("sidebar").style.display = "flex";
    }
    else{
        document.getElementById("sidebar").style.display = "none";
    }
}