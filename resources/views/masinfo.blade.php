@extends('layouts.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Información detallada</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4" style="padding-left:40px;">
                                <h5>Información personal:</h5>
                                <p>Código: <span>{{$empleados->codigo}}</span></p>
                                <p>Nombre: <span>{{$empleados->nombre}}</span></p>
                                <p>Salario en Dólares: <span>{{$empleados->salarioDolares}}</span></p>
                                <p>Salario en Pesos: <span>{{$empleados->salarioPesos}}</span></p>
                                <p>Direccion: <span>{{$empleados->direccion}}</span></p>
                                <p>Estado: <span>{{$empleados->estado}}</span></p>
                                <p>Ciudad: <span>{{$empleados->ciudad}}</span></p>
                                <p>Telefono: <span>{{$empleados->telefono}}</span></p>
                                <p>Correo: <span>{{$empleados->correo}}</span></p>
                                <p>Active: <span>{{$empleados->active}}</span></p>
                                <p></p>
                            </div>
                            <div class="col-md-6">
                                <h4>Infromación monetaria</h4>
                                <div class="table-container">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Mes</th>
                                            <th scope="col">Pesos</th>
                                            <th scope="col">Dolares</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td><p id="mes1pesos"></p></td>
                                            <td><p id="mes1dol"></p></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td><p id="mes2pesos"></p></td>
                                            <td><p id="mes2dol"></p></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td><p id="mes3pesos"></p></td>
                                            <td><p id="mes3dol"></p></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td><p id="mes4pesos"></p></td>
                                            <td><p id="mes4dol"></p></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td><p id="mes5pesos"></p></td>
                                            <td><p id="mes5dol"></p></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">6</th>
                                            <td><p id="mes6pesos"></p></td>
                                            <td><p id="mes6dol"></p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <label for="constante">Constante Multiplicativa (Insertar en décimal)</label>
                                <input id="constante" name="constante" type="decimal" class="form-control input-sm" value="0.03" onkeyup="calculo();">
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('empleados.index') }}" class="btn btn-info btn-block" >Atrás</a>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
        $( document ).ready(function() {
            calculo();
        });

        function calculo() {
            //definimos los primeros dos meses en la tabla
            var mes1pes = {{$empleados->salarioPesos}};
            $("#mes1pesos").text(mes1pes);
            var mes1dol = {{$empleados->salarioDolares}};
            $("#mes1dol").text(mes1dol);
            var constante = $("#constante").val();
            //Se realiza el ciclo para los cálculos inmediatos
            for (var i = 2; i<8;i++){
                mes1pes+=mes1pes*constante;
                mes1dol+=mes1dol*constante;
                var pesos = "mes"+i+"pesos";
                var columna = document.getElementById(pesos);
                columna.innerHTML = ""+Math.round(mes1pes);

                var dolares = "mes"+i+"dol";
                var columna2 = document.getElementById(dolares);
                columna2.innerHTML = ""+Math.round(mes1dol);
            }
        }
    </script>
@endsection