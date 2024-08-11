//evento click
$("#btnregistrar").click(function (e) { 
    //serializar parametros
    const datos=$("#frmRegistro").serialize();
    peticionGuardar(datos);

    
});

function peticionGuardar(datos){
    const url=`http://localhost:8080/crearUsuario?${datos}`
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        success: function (res) {
            alert("datos guardados");
        }
    });

}