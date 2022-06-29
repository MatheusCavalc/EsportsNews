@extends('layouts.main')

@section('title', 'Nova Noticia - Editors Only')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Preencha os campos obrigatórios e não repita titulo de outra matéria</p>
        </div>
    @endif
    <h1>Nova Noticia</h1>
    <form action="/reports" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="title">Imagem da noticia:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="title">Titulo:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo da Noticia">
        </div>
        <div class="form-group">
            <label for="date">Data da Noticia:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="game">Game:</label>
            <select class="form-control" name="game" id="game">
                <option value="" selected disabled hidden>Selecione o Game da Materia</option>
                <option value="CSGO">CSGO</option>
                <option value="R6">R6</option>
                <option value="Valorant">Valorant</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Descricao:</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Descricao da Noticia">
        </div>
        <div class="form-group">
            <label for="title">Noticia:</label>
            <textarea class="form-control" name="report" id="report" placeholder="Noticia"></textarea>
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade da Noticia">
        </div>
        <div class="form-group">
            <label for="title">Autores: (nao obrigatorio)</label>
            <input type="text" class="form-control" id="authors" name="authors" placeholder="Autores da Noticia">
        </div>
        <div class="form-group">
            <label for="title">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags da Noticia">
        </div>
            <input type="submit" class="btn btn-primary mt-3" value="Enviar Noticia">
    </form>
</div>
@endsection