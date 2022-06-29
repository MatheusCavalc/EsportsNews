@extends('layouts.main')

@section('title', 'Dashboard - Editors Only')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Minhas Materias</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($reports) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Materia</th>
               <th scope="col">Data</th>
                <th scope="col">Acoes</th>
            </tr>
        </thead>
    <tbody>
        @foreach($reports as $report)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td><a href="/reports/{{$report->id}}">{{ $report->title }}</a></td>
                <td>{{ date('d/m/Y', strtotime($report->date)) }}</td>
                <td>
                    <a href="/reports/edit/{{ $report->id }}" class="btn btn-info edit-btn"><ion-icon name="create"></ion-icon>Editar</a> 
                    <form action="/reports/{{ $report->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash"></ion-icon>Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @else
    <p>Voce nao tem noticias vinculadas, <a href="/reports/create">Criar noticia</a></p>
    @endif


@php
/*
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Acoes</th>
            </tr>
        </thead>
    <tbody>
        @foreach($eventsAsParticipant as $event)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td><a href="/events/{{$event->id}}">{{ $event->title }}</a></td>
                <td>{{ count($event->users) }}</td>
                <td>
                   <form action="/events/leave/{{ $event->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger delete-btn">
                        Sair do evento
                    </button>

                   </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @else
    <p>Voce ainda nao esta participando de nenhum evento, <a href="/">Veja todos os Eventos</a></p>
    @endif
*/
@endphp
@endsection