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
<div class="container-lg my-3 col-xs-12 col-md-6 col-lg-4 col-xl-4">
    <div class="justify-content-center d-flex mb-3">
        <h1>{{ __('messages.edAccesorio') }}</h1>
    </div>
    <form action="{{ route('editar.accesorio') }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf {{-- Cláusula para obtener un token de formulario al enviarlo --}}
        <label for="nombre" class="form-label">{{ __('messages.nombre') }}</label>
        <input type="text" required name="nombre" value="{{ old('nombre', $accesorio->nombre) }}" placeholder="{{ __('messages.nombre') }}" class="form-control mb-2" autofocus>
        @if ($errors->has('nombre'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('nombre') }}
        </div>
        @endif

        <label for="descripcion" class="form-label">{{ __('messages.descripcion') }}</label>
        <textarea type="text" required name="descripcion" placeholder="{{ __('messages.descripcion') }}" class="form-control mb-2">{{ old('descripcion', $accesorio->producto->descripcion) }}</textarea>
        @if ($errors->has('descripcion'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('descripcion') }}
        </div>
        @endif
        <label for="categorias" class="form-label">{{ __('messages.categorias') }}</label>
        <div class="containerP">
            @foreach (DB::table('categorias')->get() as $categoria)
            @if(DB::table('producto_categorias')->where('fk_producto_id', '=', $accesorio->fk_producto_id)->where('fk_categoria_id', '=', $categoria->id)
            ->exists())
            <div class="form-check">
                <input class="form-check-input" name="categorias[]" type="checkbox" value="{{ $categoria->id }}" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    {{ $categoria->nombre }}
                </label>
            </div>
            @else
            <div class="form-check">
                <input class="form-check-input" name="categorias[]" type="checkbox" value="{{ $categoria->id }}" id="flexCheck">
                <label class="form-check-label" for="flexCheckDefault">
                    {{ $categoria->nombre }}
                </label>
            </div>
            @endif
            @endforeach
        </div>

        <label for="foto" class="form-label">{{ __('messages.foto') }}</label>
        <input type="file" name="foto" class="form-control mb-2">
        @if ($errors->has('foto'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('foto') }}
        </div>
        @endif
        <label for="precio" class="form-label">{{ __('messages.precio') }}</label>
        <input type="number" required name="precio" value="{{ old('precio', $accesorio->producto->precio) }}" placeholder="{{ __('messages.precio') }}" step="0.01" class="form-control mb-2">
        @if ($errors->has('precio'))
        <div class="alert alert-danger mt-2">
            {{ $errors->first('precio') }}
        </div>
        @endif
        <div class="justify-content-center d-flex">
            <input type="hidden" name="id" value="{{ old('id', $accesorio->id) }}">
            <input type="hidden" name="idp" value="{{ old('idp', $accesorio->producto->id)}}">
            <button class="buttonP btn btn-primary btn-block m-3" type="submit">
                {{ __('messages.edAccesorio') }}
            </button>
        </div>
    </form>
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