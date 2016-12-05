@extends('blog.app')
@section('content')
<script src="//code.jquery.com/jquery-latest.js"></script>
<script>
function seleccionFacultad()
{
    var facultad = $('#facultad option:selected').text();
    $.ajax({
        url: '/universidad/departamentos/' + facultad,
        dataType: 'json',
        type: 'get',
        success: function(data)
        {
            $('#departamento').html('');
            $('#departamento').append('<option selected="selected" disabled="disabled" value = "Seleccione Departamento">Seleccione Departamento</option>');
            for(var i = 0; i < data.length; i++)
            {
                var opcion = data[i].nombre;
                $('#departamento').append('<option value = "' + opcion + '">' + opcion + '</option>');
            }
        },
        error: function()
        {
            $('#departamento').html('');
            $('#departamento').append('<option selected="selected" disabled="disabled" value = "Seleccione Facultad primero">Seleccione Facultad primero</option>');
        }
    });
}
function seleccionDepartamento()
{
    var departamento = $('#departamento option:selected').text();
    $.ajax({
        url: '/universidad/carreras/' + departamento,
        dataType: 'json',
        type: 'get',
        success: function(data)
        {
            $('#carrera').html('');
            $('#carrera').append('<option selected="selected" disabled="disabled" value = "Seleccione Carrera">Seleccione Carrera</option>');
            for(var i = 0; i < data.length; i++)
            {
                var opcion = data[i].nombre;
                $('#carrera').append('<option value = "' + opcion + '">' + opcion + '</option>');
            }
        },
        error: function()
        {
            $('#carrera').html('');
            $('#carrera').append('<option selected="selected" disabled="disabled" value = "Seleccione Departamento primero">Seleccione Departamento primero</option>');
        }
    });
    $.ajax({
        url: '/universidad/materias/' + departamento,
        dataType: 'json',
        type: 'get',
        success: function(data)
        {
            $('#materia').html('');
            $('#materia').append('<option selected="selected" disabled="disabled" value = "Seleccione Materia">Seleccione Materia</option>');
            for(var i = 0; i < data.length; i++)
            {
                var opcion = data[i].nombre;
                $('#materia').append('<option value = "' + opcion + '">' + opcion + '</option>');
            }
        },
        error: function()
        {
            $('#materia').html('');
            $('#materia').append('<option selected="selected" disabled="disabled" value = "Seleccione Departamento primero">Seleccione Departamento primero</option>');
        }
    });
}
</script>

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">Formulario de Seguimiento</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/exito') }}">
                    {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('doc_name') ? ' has-error' : '' }}">
                            <label for="doc_name" class="col-md-4 control-label">Nombre del docente</label>
                            <div class="col-md-6">
                                <select class="form-control" id="doc_name">
                                    <option selected="selected" disabled="disabled">Seleccione un Docente</option>
                                    @foreach ($docentes as $docente)
                                        <option>{{ $docente -> nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('facultad') ? ' has-error' : '' }}">
                            <label for="facultad" class="col-md-4 control-label">Facultad</label>

                            <div class="col-md-6">
                                <select class="form-control" id="facultad" onchange="seleccionFacultad();return false;">
                                    <option selected="selected" disabled="disabled">Seleccione Facultad</option>
                                    @foreach ($facultades as $facultad)
                                        <option value = "{{ $facultad -> nombre }}">{{ $facultad -> nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('departamento') ? ' has-error' : '' }}">
                            <label for="departamento" class="col-md-4 control-label">Departamento</label>

                            <div class="col-md-6">
                                <select class="form-control" id="departamento" onchange="seleccionDepartamento()">
                                    <option selected="selected" disabled="disabled" value = "Seleccione Facultad primero">Seleccione Facultad primero </option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                            <label for="carrera" class="col-md-4 control-label">Carrera</label>

                            <div class="col-md-6">
                                <select class="form-control" id="carrera">
                                    <option selected="selected" disabled="disabled">Seleccione Departamento Primero</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}">
                            <label for="carrera" class="col-md-4 control-label">Materia</label>

                            <div class="col-md-6">
                                <select class="form-control" id="materia">
                                    <option selected="selected" disabled="disabled">Seleccione Departamento primero</option>

                                </select>
                            </div>
                        </div>


                        
                       
                        <div class="form-group{}">
                            <label for="grupo" class="col-md-4 control-label">Seleccione grupo</label>

                            <div class="col-md-2">
                                <select class="form-control" id="grupo">
                                    <option selected="selected" disabled="disabled"># Grupo</option>

                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class ="form-group{}">
                            <lavel for= "grupo" class="col-md-0 control-lavel">categoria Docente</lavel>
                            <br />
                        <input name="" type="checkbox" />A(Cat)
                            <br />
                        <input name="" type="checkbox" checked="checked" />B(Adj)
                            <br />
                                <input name="" type="checkbox" />C(Asist)
                            <br />
                                <input name="" type="checkbox" />Auxiliar de Docencia    
                        </div>
                        
                    
                </div>

                <div class="panel-heading">Materias Detallado</div>

                     <div class="panel-body">
                            <p>Horario</p>
                             <div class ="form-group{}">
                            <lavel for= "grupo" class="col-md-0 control-lavel"></lavel>
                                <div class="col-md-2">
                                <select class="form-control" id="dia">
                                <label for="nombre" class="col-md-4 control-label">Dia</label>
                                    <option selected="selected" disabled="disabled">dia</option>
                                    <option>Lunes</option>
                                    <option>Martes</option>
                                    <option>Miercoles</option>
                                    <option>Jueves</option>
                                    <option>Viernes</option>
                                    <option>Sabado</option>
                                </select>
                            </div>
                            </div>
                                <div class="col-md-4">
                                <select class="form-control" id="hora">
                                <label for="nombre" class="col-md-4 control-label">horaInicio</label>
                                    <option selected="selected" disabled="disabled">hora Inicio</option>
                                    <option>6:45</option>
                                    <option>8:15</option>
                                    <option>9:45</option>
                                    <option>11:15</option>
                                    <option>12:45</option>
                                    <option>14:15</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" id="dia">
                                <label for="nombre" class="col-md-0 control-label">hora Fin</label>
                                    <option selected="selected" disabled="disabled">hora Fin</option>
                                   
                                    <option>8:15</option>
                                    <option>9:45</option>
                                    <option>11:15</option>
                                    <option>12:45</option>
                                    <option>14:15</option>
                                </select>
                            </div>

                            <div class="form-group{}">
                           
                            

                            <div class="col-md-2">
                            <label for="Aula" class="col-md-6 control-label">Aula</label>
                                <input id="aula" type="text" class="form-control" name="Aula" value="{{ old('Aula') }}" required autofocus>
                                
                                        
                                            
                               
                            </div>
                        </div>

                           <div class="form-group{}">
                            <label for="diploma" class="col-md-1 control-label">Hrs. Semana</label>

                            <div class="col-md-1">
                                <input id="" type="text" class="form-control" name="" value="{{ old('') }}" required autofocus>

                                @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{}">
                            <label for="diploma" class="col-md-1 control-label">Hrs.Teoria Mes</label>

                            <div class="col-md-1">
                                <input id="" type="text" class="form-control" name="" value="{{ old('') }}" required autofocus>

                                @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <div class="form-group{}">
                            <label for="diploma" class="col-md-1 control-label">Hrs.Practica Mes</label>

                            <div class="col-md-1">
                                <input id="" type="text" class="form-control" name="" value="{{ old('') }}" required autofocus>

                                @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{}">
                            <label for="diploma" class="col-md-1 control-label">Hrs.Mes de la Materia</label>

                            <div class="col-md-1">
                                <input id="" type="text" class="form-control" name="" value="{{ old('') }}" required autofocus>

                                @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Materia
                                </button>
                            </div>
                        </div>
                       </div>
                    <div class="panel-heading"></div>

                     <div class="panel-body">
                            <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Seguimiento
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            </div>
        </div>



@endsection