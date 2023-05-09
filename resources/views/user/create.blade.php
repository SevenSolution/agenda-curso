@extends('layouts.template')

@section('content')
    @if ($session = session('status'))
        <div>{{ $session }}</div>
    @endif

    @error('internal')
        {{$message}}
    @enderror
    <form action="{{ route('event.store') }}" method="post">
        @csrf
        <label for="title">Título</label>
        <input type="text" name="title"><br>
        <label for="start">Início</label>
        <input type="date" name="start"><br>
        <label for="end">Fim</label>
        <input type="date" name="end"><br>
        <input type="submit" value="enviar">
        @if (!empty($errors))
            {{ $errors }}
        @endif
    </form>
@endsection
