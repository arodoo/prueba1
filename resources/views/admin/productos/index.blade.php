@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('content')
    @if(Session::has('status'))
        <div class="col-md-12 alert-section">
            <div class="alert alert-{{Session::get('status_type')}}"
                 style="text-align: center; padding: 5px; margin-bottom: 5px;">
            <span style="font-size: 20px; font-weight: bold;">
                {{Session::get('status')}}
                @php
                    Session::forget('status');
                @endphp
            </span>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <ul class="">

                <a type="button" href="{{route('product.create')}}" class="btn btn-dark"
                   title="Agregar un nuevo registro"><i class="fas fa-plus"></i> Nuevo registro</a>

            </ul>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="body table-responsive">
                        <div class="row">
                            <div class="col-lg-7 col-sm-7 col-7">
                                <h5>{{$data->total()}} Registro(s) encontrado(s). Página
                                    {{($data->total() ==0) ? '0' : $data->currentPage()}} de
                                    {{$data->lastPage()}} Registros por página.
                                    {{($data->total()==0) ? '0' : $data->perPage()}}
                                </h5>
                                <div class="col-lg-5 col-sm-7 col-5">
                                    <form action="{{route('product.index')}}" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                   value="{{$search}}" placeholder="Buscar">
                                            <span class="input-group-text">
                                            <button class="btn btn-dark" type="submit">Buscar</button>
                                        </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width:5%;">Categoria</th>
                                <th style="width:5%;">Fabricante</th>
                                <th style="width:20%; padding-left: 5rem">Foto</th>
                                <th style="width:10%;">Producto</th>
                                <th style="width:20%;">Descripción</th>
                                <th style="width:10%;">Precio</th>
                                <th style="width:20%;">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>

                                    <td>{{$row->categoria->nombre}}</td>
                                    <td>{{$row->fabricante->nombre}}</td>
                                    <td>
                                        <img src="{{ URL::asset('/imagenes/productos') . '/' . $row->img }}"
                                             style="width: 8.25rem; padding-left: 2rem" alt="product-img">
                                    </td>
                                    <td>{{$row->nombre}}</td>
                                    <td>{{$row->descripcion}}</td>
                                    <td>{{$row->precio_u}}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{route('product.show', $row->id )}}"
                                           title="Mostrar producto"><i class="fas fa-eye"></i></a>

                                        <a class="btn btn-primary" href="{{route('product.edit', $row->id )}}"
                                           title="Editar producto"><i class="fas fa-pen"></i></a>

                                        <a class="btn btn-danger" href="{{route('product.delete', $row->id )}}"
                                           title="Eliminar producto"><i class="fas fa-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $data->setPath(route('product.index'))->appends(Request::except('page'))->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
