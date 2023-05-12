@extends('layout.template')

@push('css')
    <style>
        input[type=email],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=password],
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

@if ($session = session('status'))
<div>{{ $session }}</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach    
@endif
    <br>

    <div>
        <form action="{{ route('login.auth') }}" method="POST">
            @method('POST')
            @csrf
            <label for="title">E-mail</label>
            <input type="email" name="email"><br>
            <label for="start">Senha</label>
            <input type="password" name="password"><br>
           <input type="submit" value="atualizar">
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