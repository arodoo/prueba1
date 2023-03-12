@extends('adminlte::page')
@include('landing.include.head')

@section('content_header')
    @if (Session::has('status'))
        <div class="col-md-12 alert-section">
            <div class="alert alert-{{ Session::get('status_type') }}"
                style="text-align: center; padding: 5px; margin-bottom: 5px;">
                <span style="font-size: 20px; font-weight: bold;">
                    {{ Session::get('status') }}
                    @php
                        Session::forget('status');
                    @endphp
                </span>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <ul>
                <b>Categorias --> Nuevo registro</b>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información Requerida</h3>
                        </div>


                        {!! Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'put']) !!}

                        <div class="form-group">
                            {!! Form::UTTextOnly(
                                'nombre',
                                'Nombre de la categoria',
                                'Nombre de la categoria',
                                $category->nombre,
                                $errors,
                                40,
                                true,
                            ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::UTTextOnly(
                                'descripcion',
                                'Descripcion de la categoria',
                                'Descripcion de la categoria',
                                $category->descripcion,
                                $errors,
                                40,
                                true,
                            ) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a type="button" href="{{ route('users.index') }}" class="btn btn-danger">Regresar</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/validatorFields.js') }}"></script>
<@endsection()
