@extends('layouts.main')

@section('title', 'EsportsNews - ' . $game)

@section('content')
<div class="container">
<div class="col-md-12" id="reports-container">
    <h1>Veja as noticias mais recentes do {{ $game }}</h1>
    <div id="cards-container" class="row">
    @foreach($reports as $report)
        <div class="card col-md-3">
            <img src="/img/reports/{{ $report->image }}" alt="{{ $report->title }}">
            <div class="card-body">
                <div class="card-date"> {{ date('d/m/Y', strtotime($report->date)) }}</div>
                <a href="/reports/{{ $report->id }}" class="card-title">{{ $report->title }}</a>
                <p class="card-participants">{{ $report->description }}</p>
            </div>
        </div>
    @endforeach
    @if(count($reports) == 0)
        <p>Nao foi possivel encontrar noticias <a href="/">Voltar a Home</a></p>
    @endif
    </div>
</div>
</div>
@endsection