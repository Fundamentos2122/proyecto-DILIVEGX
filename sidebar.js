function sb_open(){
    document.getElementById("sidebar").style.display = "block";
    setTimeout(()=>{
        document.getElementById("sidebar").className= ' headeropen';
    }, 300);
}

function sb_close(){
    document.getElementById("sidebar").className= ' headerclose';
    setTimeout(()=>{
        document.getElementById("sidebar").style.display = "none";
    }, 300);
    
}


function change(){
    if(document.body.clientWidth>941){
        document.getElementById("sidebar").style.display = "flex";
    }
    else{
        document.getElementById("sidebar").style.display = "none";
    }
}