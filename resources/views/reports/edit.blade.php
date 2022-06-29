@extends('layouts.main')

@section('title', 'Editando Materia - Editors Only')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Preencha os campos obrigatórios</p>
        </div>
    @endif
    <h1>Editando Materia</h1>
    <form action="/reports/update/{{ $report->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="title">Imagem da Noticia:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="/img/reports/{{ $report->image }}" alt="{{ $report->title }}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo da Noticia" value="{{ $report->title }}">
        </div>
        <div class="form-group">
            <label for="date">Data da Noticia:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $report->date->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="game">Game:</label>
            <select class="form-control" name="game" id="game">
                <option value="{{ $report->game }}" selected hidden>{{ $report->game }}</option>
                <option value="CSGO">CSGO</option>
                <option value="R6">R6</option>
                <option value="Valorant">Valorant</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Descricao:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Descricao da Noticia" value="{{ $report->description }}">
        </div>
        <div class="form-group">
            <label for="title">Noticia:</label>
            <textarea class="form-control" name="report" id="report" placeholder="Noticia">{{ $report->report }}</textarea>
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade da Noticia" value="{{ $report->city }}">
        </div>
        <div class="form-group">
            <label for="title">Autores:</label>
            <input type="text" class="form-control" id="authors" name="authors" placeholder="Autores da Noticia" value="{{ $report->authors }}">
        </div>
        <div class="form-group">
            <label for="title">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags da Noticia" value="{{ $report->tags }}">
        </div>
            <input type="submit" class="btn btn-primary mt-3" value="Enviar Noticia">
    </form>
</div>

@endsection