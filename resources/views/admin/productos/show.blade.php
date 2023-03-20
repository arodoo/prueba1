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
                <b> Mostrar Categoria</b>
            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Bonjorno</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-4 col-sm-4 col-4">
                                {!! Form::UTTextOnly('nombre', 'Nombre del producto', 'Nombre del producto a registrar', $product->nombre, $errors, 40, true,true) !!}
                            </div>

                            <div class="col-lg-4 col-sm-4 col-4">
                                {!! Form::UTTextOnly('descripcion', 'Descripción del producto', 'Descripción del producto a registrar', $product->descripcion, $errors, 80, true,true) !!}
                            </div>

                            <div class="col-lg-4 col-sm-4 col-4">
                                {!! Form::UTFloat('precio_u', 'Precio unitario', 'Precio unitario del producto', $product->precio_u, $errors, 30, true,true,) !!}
                            </div>

                            <div class="col-lg-4 col-sm-4 col-4">
                                {!! Form::UTFloat('precio_m', 'Precio mayoreo', 'Precio mayoreo del producto', $product->precio_m, $errors, 30, true,true) !!}
                            </div>

                            <div class="col-lg-4 col-sm-4 col-4" >
                                {!! Form::UTNumeric('cantidad_m', 'Cantidad mayoreo', 'Cantidad mayoreo del producto', $product->cantidad_m, $errors, 30, true,true) !!}
                            </div>

                            <td>
                                <img src="{{ URL::asset('/imagenes/productos') . '/' . $product->img }}"
                                     style="width: 100px">
                            </td>
                        </div>
                        <div class="card-footer">
                            <a type="button" href="{{ route('category.index') }}" class="btn btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('js/validatorFields.js') }}"></script>

@endsection()
