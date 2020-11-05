@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-md-offset-2">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="alert alert-info">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Empleado</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('empleados.store') }}"  role="form" id="regf">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="codigo" id="codigo" class="form-control input-sm" placeholder="Código">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nombre" pattern="[a-zA-Z ]{2,120}" id="nombre" class="form-control input-sm" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="number" min="1" name="salarioPesos" id="salarioPesos" class="form-control input-sm" placeholder="Salario en Pesos" onfocusout="obdl();">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <input type="double" name="salarioDolares" id="salarioDolares" class="form-control input-sm" placeholder="Salario en Dólares" onfocusout="obpe();">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            <p>Valor de cambio al día: <span id="cambio"></span></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="Direccion">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="estado" id="estado" class="form-control input-sm" placeholder="Estado">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="ciudad" id="ciudad" class="form-control input-sm" placeholder="Ciudad">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="tel" maxlength="10" name="telefono" id="telefono" class="form-control input-sm" placeholder="Telefono">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="correo" id="correo" class="form-control input-sm" placeholder="Correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit"  value="Guardar" class="btn btn-success btn-block">
                                        <a href="{{ route('empleados.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-2"></div>
        <!--OBTUVIMOS LA API DE BANXICO CON JAVASCRIPT POR COMODIDDAD <script src="../../resources/assets/js/dolares.js"></script>-->
        <script>
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
                            var mult = Math.round(pesos/reg);
                            $("#salarioDolares").val(mult);
                            console.log($("#salarioDolares").val());
                            $("#cambio").text(reg);
                        }
                    }
                });
            }
            function obpe() {
                var dolares = $("#salarioDolares").val();
                var f = new Date();
                var fecha = f.getFullYear() + "-" + (f.getMonth()+1) + "-" + (f.getDay()+1);
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
                            var mult = Math.round(reg*dolares);
                            console.log(""+reg+"---"+dolares);
                            $("#salarioPesos").val(mult);
                            console.log($("#salarioPesos").val());
                            $("#cambio").text(reg);
                        }
                    }
                });
            }

        </script>
@endsection
