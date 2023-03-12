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
                <b>Usuarios || Nuevo registro</b>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Información Requerida</h3>
                        </div>


                        {!! Form::open(['route' => 'users.store', 'method' => 'post', 'entype' => 'multipart/form-data']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::UTTextOnly('name', 'Nombre del usuario', 'Nombre del usuario', null, $errors, 40, true) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::UTEmail('email', 'Correo electrónico', 'Correo electrónico', null, $errors, 50, true) !!}
                            </div>
                            <div class="float-container">
                                <div class="float-child">
                                    <div class="form-group ">
                                        {!! Form::UTPassword('password', 'Contraseña', 'Contraseña', $errors, 8, 10) !!}
                                    </div>
                                </div>
                                <div class="float-child">
                                    <div class="form-group">
                                        {!! Form::UTPassword('InputPassword2', 'Confirmar contraseña', 'Confirmar contraseña', $errors, 8, 10) !!}
                                    </div>
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
