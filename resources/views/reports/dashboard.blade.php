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


        @if ($user->admin)
        <h1>Novo Editor</h1>
            <form action="/reports/makeeditor" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="title">Novo Editor</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email do novo editor">
            </div>
            </form>
        @endif
@endsection