@extends('plantilla')
@section('contenido')
@guest
{{ app()->setLocale('es') }}

@else
@if (Auth::user()->language == 'es')
{{ app()->setLocale('es') }}
@else
{{ app()->setLocale('en') }}
@endif
@endguest
<div class="container-lg my-3 col-xs-12 col-sm-10 col-md-8 col-lg-8 col-xl-8">
    <div class="justify-content-center d-flex mb-3">
        <h1>{{ old('nombre', $accesorio->nombre) }}</h1>
    </div>

    @if (Auth::user()->isAdmin() == false)
    @if(DB::table('favoritos')
    ->join('favorito_productos', 'favoritos.id', '=', 'favorito_productos.fk_favorito_id')
    ->where('favorito_productos.fk_producto_id', '=', old('id', $accesorio->fk_producto_id) )
    ->where('favoritos.fk_user', '=', Auth::id())
    ->exists())
    <div class="d-flex justify-content-center my-3">
        <form action="{{ route('eliminarFavorito') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="idf" value="{{  old('id', $accesorio->fk_producto_id) }}">
            <button class="buttonP btn btn-danger btn-block" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="yellow" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>
            </button>
        </form>
    </div>
    @else
    <div class="d-flex justify-content-center my-3">
        <form action="{{ route('addToFavoritos') }}" method="POST">
            @csrf
            <input type="hidden" name="idf" value="{{  old('id', $accesorio->fk_producto_id) }}">
            <button class="buttonP btn btn-danger btn-block" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg>
            </button>
        </form>
    </div>
    @endif
    @endif

    <p>
        {{ old('descripcion', $accesorio->producto->descripcion) }}
    </p>

    <div>
        <div class="mb-3">
            <img src="{{ old('foto', $accesorio->producto->foto)}}" class="rounded float-start h-25 w-25" alt="{{ old('nombre', $accesorio->nombre) }}">
        </div>


        <div class="d-flex justify-content-right">
            <div class="mx-5">
                <p><b>{{ __('messages.nombre') }}: </b>{{ old('nombre', $accesorio->nombre) }}</p>
                <p><b>{{ __('messages.categorias') }}: </b>
                    @foreach ($accesorio->producto->productos_categorias as $categoria)
                    {{ $categoria->categoria->nombre }}<br>
                    @endforeach
                </p>
                <p><b>{{ __('messages.precio') }}: </b>{{ old('precio', $accesorio->producto->precio) }}</p>
            </div>
        </div>
    </div>


    <div class="mt-5">

        @if (Auth::user()->isAdmin() == false)

        <div class="d-flex justify-content-center">
            <form action="{{ route('addToCarrito') }}" method="POST">
                @csrf
                <label>{{ __('messages.cantidad') }}: </label>
                <input type="number" name="cantidad" value="{{ old('cantidad', 1) }}">
                @if ($errors->has('cantidad'))
                <div class="alert alert-danger mt-2">
                    {{ $errors->first('cantidad') }}
                </div>
                @endif

                <input type="hidden" name="tipo" value="accesorio">
                <input type="hidden" name="id" value="{{ old('id', $accesorio->fk_producto_id) }}">

                <button class="buttonP btn btn-danger btn-block" type="submit">
                    {{ __('messages.addCarrito') }}
                </button>
            </form>
        </div>

        @endif
        @if (Auth::user()->isAdmin() == false)
        <div class="d-flex justify-content-start mt-5">
            <form action="{{ route('mostrarProductos') }}" method="GET">
                @csrf
                <button class="btn btn-danger btn-block" type="submit">
                    {{ __('messages.atras') }}
                </button>
            </form>
        </div>

        @else
        <div class="d-flex justify-content-start mt-5">
            <form action="{{ route('mostrarAccesorios') }}" method="GET">

                @csrf
                <button class="btn btn-danger btn-block" type="submit">
                    {{ __('messages.atras') }}
                </button>
            </form>
        </div>

        @endif

    </div>
    @endsection