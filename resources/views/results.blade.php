@extends('layout/master')

@section('title', 'Squad')

@section('content')
<div class="allresults">
    <header class="monthresults">
        <h3><b>APRIL</b></h3>
    </header>
    <div class="card-container">
        <div class="grid-container">
            <h4 class="april1_result_name">Vs TryGo</h4>
            <p class="april1_result_result"><b>1 - 3</b></p>
            <p class="april1_result_date">15th - 21:00</p>
        </div>
    </div>

    <header class="monthresults">
        <h3><b>MAY</b></h3>
    </header>
    <div class="card-container">
        <div class="grid-container">
            <h4 class="may1_result_name">Vs Patta</h4>
            <p class="may1_result_result"><b>5 - 3</b></p>
            <p class="may1_result_date">7th - 22:30</p>
        </div>
    </div>

    <header class="monthresults">
        <h3><b>JUNE</b></h3>
    </header>
    <div class="card-container">
        <div class="grid-container">
            <h4 class="june1_result_name">Vs Rasta</h4>
            <p class="june1_result_result"><b>4 - 7</b></p>
            <p class="june1_result_date">25th - 18:00</p>
        </div>
    </div>
    <div class="card-container">
        <div class="grid-container">
            <h4 class="june2_result_name">Vs Bragas</h4>
            <p class="june2_result_result"><b>2 - 3</b></p>
            <p class="june2_result_date">30th - 20:45</p>
        </div>
    </div>

    <header class="monthresults">
        <h3><b>JULY</b></h3>
    </header>
    <div class="card-container">
        <div class="grid-container">
            <h4 class="july1_result_name">Vs Paraouk</h4>
            <p class="july1_result_result"><b>8 - 3</b></p>
            <p class="july1_result_date">14th - 20:00</p>
        </div>
    </div>
</div>

<div class="selectedresult">
    <p class="versus"><b>VS</b></p>
    <div class="resultimg">
        <img src="{{ asset('/images/brighton.png')}}" alt="Opponent Logo" class="oppologo">
    </div>
    <div class="resultdetails">
        <h4>Full Time</h4>
        <p>April 15</p>
        <p>21:00</p>
        <p>TryGo Arena</p>
        <p>Ref : Sir Mat Nor</p>
    </div>
    <p class="score"><b>1 - 3</b></p>
    <div class="grid-container resultscore">
        <img src="{{ asset('/images/ball.png')}}" alt="Ball" class="icon_ball1">
        <p class="scorer1">Faiz</p>
        <p class="time1">8'</p>

        <img src="{{ asset('/images/ball.png')}}" alt="Ball" class="icon_ball2">
        <p class="scorer2">Faiz</p>
        <p class="time2">10'</p>

        <img src="{{ asset('/images/ball.png')}}" alt="Ball" class="icon_ball3">
        <p class="scorer3">Haniff</p>
        <p class="time3">19'</p>

        <img src="{{ asset('/images/ball.png')}}" alt="Ball" class="icon_ball4">
        <p class="scorer4">Opponent</p>
        <p class="time4">1'</p>
    </div>
</div>
@endsection