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
    </style>
@endpush

@section('content')
<br><br>
    <a href="{{ route('events.create') }}" id="button">Cadastrar</a><br><br><br>

        @if ($session = session('status'))
            <div>{{ $session }}</div>
        @endif

        @error('internal')
            {{ $message }}
        @enderror

        <table id="customers">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Título</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->user->name }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start }}</td>
                        <td>{{ $event->end }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event->id) }}">Editar</a>&nbsp;&nbsp;
                            <a href="">Excluir</a>
                        </td>
                    </tr>
                @endforeach
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


        <hr>
        <br><br><br><br>
    @endsection
