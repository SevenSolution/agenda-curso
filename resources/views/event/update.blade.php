@extends('layout.template')

@section('content')
  
    @error('internal')
        {{$message}}
    @enderror
  <br>
    <form action="{{ route('events.update', $event->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="title">Título</label>
        <input type="text" value="{{$event->title}}" name="title"><br>
        <label for="start">Início</label>
        <input type="date" value="{{$event->start}}" name="start"><br>
        <label for="end">Fim</label>
        <input type="date" value="{{$event->end}}" name="end"><br>
        <input type="submit" value="atualizar">
        @if (!empty($errors))
            {{ $errors }}
        @endif
    </form>
@endsection
