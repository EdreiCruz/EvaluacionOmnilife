function obdl() {
    var pesos = $("#salarioPesos").val();
    $("#salarioDolares");
    var fecha = "2020-11-04";
    $.ajax({
        url : "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/"+fecha+"/"+fecha+"?token=0fce7d85c76c9afa6f8ef05f95d50a11c62573c637d28706e28f2a81e84264e5",
        jsonp : "callback",
        dataType : "jsonp", //Se utiliza JSONP para realizar la consulta cross-site
        success : function(response) {  //Handler de la respuesta
            var series=response.bmx.series;
            //Se carga una tabla con los registros obtenidos
            for (var i in series) {
                var serie=series[i];
                var reg=+serie.datos[0].dato
                console.log(reg);
                var mult = pesos/reg;
                $("#salarioDolares").val(mult);
            }
        }
    });
}