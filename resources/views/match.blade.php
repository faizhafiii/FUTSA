@extends('layout/master')

@section('title', 'Match')

@section('content')

    <div class="matchhometeam">
        <div class="card_hometeam">
            <header class="teamname">
                <h3><b>HOME</b></h3>
            </header>
            <p class="homescore">1</p>
        </div>
        <br>
        <br>
        <div class="card_homeplayer">
            <p class="playername">PLAYER 1</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_homeplayer">
            <p class="playername">PLAYER 2</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_homeplayer">
            <p class="playername">PLAYER 3</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_homeplayer">
            <p class="playername">PLAYER 4</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_homeplayer">
            <p class="playername">PLAYER 5</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
    </div>


    {{-- <div class="matchhometeam">
        <div class="card_hometeam">
            <header class="teamname">
                <h3><b>HOME</b></h3>
            </header>
            <div class="grid-container desc">
                <p class="homescore">1</p>
            </div>
        </div>
    </div>
    
    <div class="matchhometeam">
        <div class="card_hometeam">
            <header class="teamname">
                <h3><b>HOME</b></h3>
            </header>
            <div class="grid-container desc">
                <p class="homescore">1</p>
            </div>
        </div>
    </div> --}}

    <div class="matchawayteam">
        <div class="card_awayteam">
            <header class="teamname">
                <h3><b>AWAY</b></h3>
            </header>
            <p class="awayscore">0</p>
        </div>
        <br>
        <br>
        <div class="card_awayplayer">
            <p class="playername">PLAYER 1</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_awayplayer">
            <p class="playername">PLAYER 2</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_awayplayer">
            <p class="playername">PLAYER 3</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_awayplayer">
            <p class="playername">PLAYER 4</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
        <div class="card_awayplayer">
            <p class="playername">PLAYER 5</p>
            <button type="submit" class="scorebtn">Score</button>
            <button type="submit" class="assistbtn">Assist</button>
            <button type="submit" class="yellowcardbtn">Yellow Card</button>
            <button type="submit" class="redcardbtn">Red Card</button>
        </div>
        <br>
    </div>

    <div class="matchbutton">
        <a class="button start">Start</a>
        <a class="button stop">Stop</a>
        <a class="button halftime">Half-Time</a>
        <a class="button fulltime">Full-Time</a>
    </div>






    <script></script>

@endsection
