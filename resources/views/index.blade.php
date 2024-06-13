@extends('layout/master')

@section('title', 'Home')

@section('content')
    <div class="upper">
        <div class="card_upcomingmatch">
            <header class="title1_container">
                <h4><b>UPCOMING MATCH</b></h4>
                <p>Sun 14 May 2023 | 17:00 | UTP V1 Court</p>
            </header>
            <div class="grid-container matchcontainer">
                <div class="grid-item hometeam">
                    <img src="{{ asset('/images/raptorsbg.png')}}" alt="Raptors" class="home">
                </div>
                <div class="grid-item vs">
                    <h4>VS</h4>
                </div>
                <div class="grid-item awayteam">
                    <img src="{{ asset('/images/vsick.png')}}" alt="vsick" class="away">
                </div>
            </div>
        </div>

        <div class="card_lastmatch">
            <header class="title2_container">
                <h4><b>LAST MATCH RESULT</b></h4>
                <p>Mon 10 April 2023 | 22:30 | UTP V1 Court</p>
            </header>
            <div class="grid-container matchcontainer">
                <div class="awayteam">
                    <img src="{{ asset('/images/brighton.png')}}" alt="Opponent" class="away">
                </div>
                <div class="awayname">
                    <h4>BRIGHTON</h4>
                </div>
                <div class="result">
                    <p>0 - 3</p>
                </div>
            </div>
        </div>
    </div>


    <div class="lower">
        <div class="card_currentform">
            <header class="title3_container">
                <h4><b>CURRENT FORM</b></h4>
                <p>Last 5</p>
            </header>
            <div class="formcontainer">
                <div class="last1">
                    <img src="{{ asset('/images/win.png')}}" alt="Win" class="win1">
                </div>
                <div class="last2">
                    <img src="{{ asset('/images/draw.png')}}" alt="Draw" class="draw1">
                </div>
                <div class="last3">
                    <img src="{{ asset('/images/lose.png')}}" alt="Lose" class="lose1">
                </div>
                <div class="last4">
                    <img src="{{ asset('/images/win.png')}}" alt="Raptors" class="win2">
                </div>
                <div class="last5">
                    <img src="{{ asset('/images/win.png')}}" alt="Raptors" class="win3">
                </div>

            </div>
        </div>

        <div class="card_yearperformance">
            <header class="title4_container">
                <h4><b>YEAR PERFORMANCE</b></h4>
                <p>2023</p>
            </header>
            <div class="grid-container performancecontainer">
                <div class="p-play">
                    <h3>P</h3>
                    <p>20</p>
                </div>
                <div class="p-win">
                    <h3>W</h3>
                    <p>15</p>
                </div>
                <div class="p-draw">
                    <h3>D</h3>
                    <p>3</p>
                </div>
                <div class="p-lose">
                    <h3>L</h3>
                    <p>2</p>
                </div>
                <div class="p-gs">
                    <h3>GS</h3>
                    <p>33</p>
                </div>
                <div class="p-ga">
                    <h3>GA</h3>
                    <p>9</p>
                </div>
            </div>
        </div>
    </div>
@endsection