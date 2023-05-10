@extends('layout.template')

@section('content')
<a href="{{ route('events.create') }}">Cadastrar</a>&nbsp; <<<<<<< Criar novo evento<br><br><br>

<table>
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Título</th>
            <th>Início</th>
            <th>Fim</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{$event->user->name}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->start}}</td>
                <td>{{$event->end}}</td>
                <td>
                    <a href="">Editar</a>
                    <a href="">Excluir</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
