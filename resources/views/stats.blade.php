@extends('layout/master')

@section('title', 'Squad')

@section('content')
<div class="statsgoals">
    <header class="statstitle">
        <h3><b>Goals</b></h3>
    </header>
    <div class="card-container topplayer">
        <div class="grid-container1 statsplayer">
            <h4 class="statsnum1">1</h4>
            <h4 class="statsname1">Ahmad Faiz Hafidzin</h4>
            <p class="statsgoal1">27</p>
            <img src="{{ asset('/images/player.png')}}" alt="Player" class="playerimg">
        </div>
    </div>

    <div class="grid-container2 listscorer">
        <header class="playerpos">
            <h5 class="">Pos</h5>
        </header>
        <header class="playername">
            <h5 class="">Player</h5>
        </header>
        <header class="playerval">
            <h5 class="">Value</h5>
        </header>

        <p class="statsnum2">2</p>
        <p class="statsname2">Ahmad</p>
        <p class="statsgoal2">25</p>

        <p class="statsnum3">3</p>
        <p class="statsname3">Ali</p>
        <p class="statsgoal3">20</p>

        <p class="statsnum4">4</p>
        <p class="statsname4">Abu</p>
        <p class="statsgoal4">17</p>
    </div>
</div>

<div class="statsassists">
    <header class="statstitle">
        <h3><b>Assists</b></h3>
    </header>
    <div class="card-container topplayer">
        <div class="grid-container1 listassister">
            <h4 class="statsnum1">1</h4>
            <h4 class="statsname1">Ahmad Faiz Hafidzin</h4>
            <p class="statsgoal1">10</p>
            <img src="{{ asset('/images/player.png')}}" alt="Player" class="playerimg">
        </div>
    </div>

    <div class="grid-container2 listassister">
        <header class="playerpos">
            <h5 class="">Pos</h5>
        </header>
        <header class="playername">
            <h5 class="">Player</h5>
        </header>
        <header class="playerval">
            <h5 class="">Value</h5>
        </header>

        <p class="statsnum2">2</p>
        <p class="statsname2">Ahmad</p>
        <p class="statsgoal2">9</p>

        <p class="statsnum3">3</p>
        <p class="statsname3">Ali</p>
        <p class="statsgoal3">5</p>

        <p class="statsnum4">4</p>
        <p class="statsname4">Abu</p>
        <p class="statsgoal4">2</p>
    </div>
</div>
@endsection