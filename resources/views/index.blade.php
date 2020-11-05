@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="pull-left"><h3>Lista de Empleados</h3></div>
                        <div class="pull-right">
                            <div class="btn-group">
                                <a href="{{ route('empleados.create') }}" class="btn btn-info" style="margin-bottom: 10px;">Añadir Empleado</a>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Salario Dólares</th>
                                <th>Salario Pesos</th>
                                <th>Correo</th>
                                <th>Status</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <th>C. Status</th>
                                <th>Info</th>
                                </thead>
                                <tbody>
                                @if($empleados->count())
                                    @foreach($empleados as $empleado)
                                        <tr>
                                            <td>{{$empleado->codigo}}</td>
                                            <td>{{$empleado->nombre}}</td>
                                            <td>{{$empleado->salarioDolares}}</td>
                                            <td>{{$empleado->salarioPesos}}</td>
                                            <td>{{$empleado->correo}}</td>
                                            <td>@if($empleado->active == 0)<a class="btn btn-danger btn-xs" style="color:white;">Inactivo {{$empleado->active}}</a>@else<a class="btn btn-success btn-xs" style="color:white;">Activo {{$empleado->active}}</a>@endif</td>
                                            <td><a class="btn btn-primary btn-xs" href="{{action('empleadosController@edit', $empleado->id)}}" ><span class="glyphicon glyphicon-pencil">Editar</span></a></td>
                                            <td>
                                                <form action="{{action('empleadosController@destroy', $empleado->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash">Eliminar</span></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{action('empleadosController@cambiostat', $empleado->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    <input type="text" value="1" hidden id="active" name="active">
                                                    <button class="btn btn-success btn-xs" type="submit"><span class="glyphicon glyphicon-trash">Cambiar</span></button>
                                                </form>
                                            </td>
                                            <td><a class="btn btn-info btn-xs" href="{{action('empleadosController@status', $empleado->id)}}" ><span class="glyphicon glyphicon-pencil">Info</span></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No existen registros</td>
                                    </tr>
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                    {{ $empleados->links() }}
                </div>
            </div>
        <div class="col-md-2"></div>
@endsection