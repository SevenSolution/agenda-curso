@extends('layout.template')
@push('css')
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=date],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            width: 30%;
        }

        #button {
            font-family: Arial, Helvetica, sans-serif;
            text-decoration: none;
            width: 100%;
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #button:hover {
            background-color: #45a049;
        }
    </style>
@endpush


@section('content')
    <br><br>
    <a href="{{ route('events.index') }}" id="button">Ver Todos</a><br><br><br>



    @if ($session = session('status'))
        <div>{{ $session }}</div>
    @endif

    @error('internal')
        {{ $message }}
    @enderror

    <div>
        <form action="{{ route('events.store') }}" method="post">
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
    </div>
@endsection

@section('doubts')
<br><br><br><br>
<b>Dúvidas</b>
<br><br>
<hr>
--- Por que quando gera erro o $errors fica com charset diferente?
<hr>
<br><br><br><br>
@endsection