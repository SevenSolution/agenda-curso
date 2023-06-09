@extends('layout.template')

@push('css')
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }


        input[type=submit]:hover {
            background-color: #45a049;
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

        #diverror {
            border-radius: 5px;
            background-color: red;
            color: #ffffff;
            padding: 20px;
            width: 100%;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <br><br>
    <a href="{{ route('login.logout') }}" id="button">Sair</a><br><br><br>

    <br><br>
    <a href="{{ route('events.index') }}" id="button">Ver Todos</a><br><br><br>
    
    @if ($session = session('status'))
        <div>{{ $session }}</div>
    @endif

    @error('internal')
        <div id="diverror"> {{ $message }} </div>
    @enderror

    <table id="customers">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Título</th>
                <th>Início</th>
                <th>Fim</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $event->user->name }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y') }}</td>
                    <td>{{ is_null($event->end) ? '00/00/0000' : \Carbon\Carbon::parse($event->end)->format('d/m/Y') }}</td>
                </tr>
 
        </tbody>
    </table>
@endsection

@section('doubts')
    <br><br><br><br>
    <b>Dúvidas</b>
    <br><br>
    <hr>
    --- Como converter no MODEL a data para "d-m-Y" ao exibir e ao editar converter novamente para "Y-m-d"?
    <br> deverá ser nas views? <br><br>
    public function getStartAttribute($value)<br>
    {<br>
    return Carbon::parse($value)->format('d/m/Y');<br>
    }<br><br>
    <br> converte, mas na hora de editar não 'puxa' para o input:data
    <hr><br>
    Ao editar e excluir o usuário pode manipular a URL, como resolver?

    <hr>
    <br><br><br><br>
@endsection
