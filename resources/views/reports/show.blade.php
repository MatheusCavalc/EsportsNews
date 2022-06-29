@extends('layouts.main')

@section('title', $report->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
            <h2>{{ $report->title }}</h5>
            <p> Por {{ $reportOwner['name'] }} {{ $report->authors }}</p>
            <p><ion-icon name="pin"></ion-icon> {{ $report->city }} - <ion-icon name="calendar"></ion-icon> {{ date('d/m/Y', strtotime($report->date)) }} </p>
            <h5>{{ $report->description }}</h5>
            <img src="/img/reports/{{ $report->image }}" alt="{{ $report->title }}">
            <p>{{ $report->report }}</p>
            
        <div class="mt-2">
                @foreach($report->tags as $tags)
                    <span><ion-icon name="pricetags"></ion-icon> {{ $tags }}</span>
                @endforeach
        </div>

        <form action="/reports/makecomment/{{ $report->id }}" method="POST">
                @csrf
            <div class="form-group">
                <label for="title">Fazer um comentario</label>
                <input type="text" class="form-control" id="comment" name="comment">
            </div>
        </form>

        <h3 class="mt-3"> Comentarios </h3>
        <p>{{ count($comments) }} comentarios:</p>
        @foreach($comments as $comment)
            <h5> {{ $comment->user }} </h5>
            <p> {{ $comment->comment }} </p>
            @if($user)
                @if($user->id == $comment->user_id)
                    <form action="/reports/deletecomment/{{ $comment->id }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash"></ion-icon>
                            Deletar Comentario
                        </button>
                    </form>
                @endif
            @endif
        @endforeach

    </div>
</div>
@endsection