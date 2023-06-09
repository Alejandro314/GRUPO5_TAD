@extends('plantilla')
@section('titulo', 'INICIO')
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


<div class="container-lg my-3 col-xs-10 col-md-8 col-lg-8 col-xl-8">
    <div class="justify-content-center d-flex mb-3">
        <h1>{{ __('messages.rankingFavoritos') }}</h1>
    </div>
    @if ($productos->isEmpty())
    <div class="alert alert-info">
        <span>{{ __('messages.noFavoritos') }}</span>
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped rounded-2 bg-white">
            <thead>
                <tr class="table-row  text-center align-middle">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.producto') }}</th>
                    <th>{{ __('messages.favorito') }}</th>
                </tr>
            </thead>
            @foreach ($productos as $producto)
            <tr class="table-row text-center align-middle">
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ count($producto->favoritos_productos) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
</div>
@endsection