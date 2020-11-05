@extends('layouts.layout')
@section('content')
    <div class="row">
        <section class="content">
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

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar Registro</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-container">
                            <form method="POST" action="{{ route('empleados.update',$empleados->id) }}"  role="form">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="codigo" id="codigo" class="form-control input-sm" value="{{$empleados->codigo}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$empleados->nombre}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="salarioPesos" id="salarioPesos" class="form-control input-sm" onfocusout="obdl();" value="{{$empleados->salarioPesos}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="salarioDolares" id="salarioDolares" class="form-control input-sm" onfocusout="obpe();" value="{{$empleados->salarioDolares}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="direccion" id="direccion" class="form-control input-sm" value="{{$empleados->direccion}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="estado" id="estado" class="form-control input-sm" value="{{$empleados->estado}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="ciudad" id="ciudad" class="form-control input-sm" value="{{$empleados->ciudad}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="telefono" id="telefono" class="form-control input-sm" value="{{$empleados->telefono}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="correo" id="correo" class="form-control input-sm" value="{{$empleados->correo}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                                        <a href="{{ route('empleados.index') }}" class="btn btn-info btn-block" >Atrás</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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