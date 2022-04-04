
var bool = 0;
function filter(){
    if(bool==0){
        filter_open();
        bool=1;
    }
    else if(bool==1){
        filter_close();
        bool=0;
    }
}

function filter_open(){
    document.getElementById("filter").style.display = "block";
    
    setTimeout(()=>{
        document.getElementById("filter").className=' filteropen';
    }, 300);
}

function filter_close(){
    document.getElementById("filter").className= ' filterclose';
    setTimeout(()=>{
        document.getElementById("filter").style.display = "none";
    }, 300);
    
}