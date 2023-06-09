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
<div class="container-lg my-3 col-xs-10 col-md-8 col-lg-8 col-xl-8">
    <div class="justify-content-center d-flex mb-3">
        <h1>{{ __('messages.miPerfil') }}</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success d-flex justify-content-center w-100">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('updatePerfil') }}" method="POST">
        @method('PUT')
        @csrf
        <table class="table m-3 rounded-2 bg-white">
            <tr class="table-row  text-center align-middle">
                <td class="fw-bold">{{ __('messages.nombre') }}</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr class="table-row  text-center align-middle">
                <td class="fw-bold">{{ __('messages.apellidos') }}</td>
                <td>{{ Auth::user()->surname }}</td>
            </tr>
            <tr class="table-row  text-center align-middle">
                <td class="fw-bold">{{ __('messages.correo') }}</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr class="table-row  text-center align-middle">
                <td class="fw-bold">{{ __('messages.telefono') }}</td>
                <td>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                    @if ($errors->has('phone'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('phone') }}
                    </div>
                    @endif
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                </td>
            </tr>
            <tr class="table-row  text-center align-middle">
                <td class="fw-bold">{{ __('messages.idioma') }}</td>
                <td class="justify-content-center d-flex">
                    <select class="form-select h-50 w-50" name="language" aria-label="Default select example">
                        @if (Auth::user()->language == 'es')
                        <option selected value="es">{{ __('messages.es') }}</option>
                        <option value="en">{{ __('messages.en') }}</option>
                        @else
                        <option value="es">{{ __('messages.es') }}</option>
                        <option selected value="en">{{ __('messages.en') }}</option>
                        @endif
                    </select>
                </td>
            </tr>
        </table>
        <div class="justify-content-center d-flex">
            <button class="buttonP btn btn-primary btn-block m-3" type="submit">
                {{ __('messages.acUser') }}
            </button>
            <a class="btn btn-danger m-3" href="{{ route('updatePass') }}">
                {{ __('messages.cambiarPass') }}
            </a>
        </div>

    </form>
    


</div>
@endsection