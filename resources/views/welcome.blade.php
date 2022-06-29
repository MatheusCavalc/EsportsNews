@extends('layouts.main')

@section('title', 'EsportsNews')

@section('content')
<div class="container">
<div class="col-md-12" id="reports-container">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Noticias</h2>
    <p>Veja as noticias mais recentes</p>
    @endif
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
    @if(count($reports) == 0 && $search)
        <p>Nao foi possivel encontrar noticias com {{ $search }}! <a href="/">Voltar a Home</a></p>
    @endif
    </div>
</div>
</div>
@endsection