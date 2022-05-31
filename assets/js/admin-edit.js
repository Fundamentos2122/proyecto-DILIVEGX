document.addEventListener("DOMContentLoaded", function(){

})


var file;
function handleFiles(files){
    file = files[0];
    if(files[0].type=="image/jpeg"){
    }
}
function chequeo(){
    if(document.getElementsByName("name")[0].value=="")
        window.location.href = window.location.href+"&error=No se insertó un nombre";
    else if(document.getElementsByName("desc")[0].value=="")
        window.location.href = window.location.href+"&error=No se insertó una descripción";
    else if(document.getElementsByName("price")[0].value=="")
        window.location.href = window.location.href+"&error=No se insertó un precio";
    else if(document.getElementsByName("brand")[0].value=="")
        window.location.href = window.location.href+"&error=No se insertó una marca";
    else if((document.getElementsByName("socket")[0].value=="" && document.getElementsByName("types")[0].value=="cpu")||(document.getElementsByName("socket")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href = window.location.href+"&error=No se insertó un socket, requerido en CPU o MB";
    else if((document.getElementsByName("ff")[0].value=="" && document.getElementsByName("types")[0].value=="cas")||(document.getElementsByName("ff")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href = window.location.href+"&error=No se insertó un factor de forma, requerido en CASE o MB";
    else if((document.getElementsByName("ddr")[0].value=="" && document.getElementsByName("types")[0].value=="ram")||(document.getElementsByName("ddr")[0].value=="" && document.getElementsByName("types")[0].value=="mb"))
        window.location.href = window.location.href+"&error=No se insertó un factor de forma, requerido en RAM o MB";
    else{
        return true;
    }
    return false;
}