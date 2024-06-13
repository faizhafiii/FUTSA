@extends('layout/master')

@section('title', 'Profile')

@section('content')
    <div class="userprofile">
        <div class="playerimg">
            <img src="{{ asset('/images/player.png') }}" alt="Player Picture" class="playerpic">
            <hr>
        </div>
        <div class="card_playerdesc">
            <div class="grid-container desc">
                <p class="dname1"><b>Name</b></p>
                <p class="dname2">{{ $userDetails->fullname ?? 'John Doe' }}</b></p>

                <p class="dnum1"><b>Squad Number</b></p>
                <p class="dnum2">10</b></p>

                <p class="dbirth1"><b>Date of Birth</b></p>
                @php
                    $dateString = $userDetails->dob ?? '2020-08-03';
                    $dateTime = new DateTime($dateString);
                    $formattedDate = $dateTime->format('M d, Y');
                @endphp
                <p class="dbirth2">{{ $formattedDate ?? 'Player DOB' }}</b></p>

                <p class="dstate1"><b>State</b></p>
                <p class="dstate2">{{ $userDetails->state ?? 'Somewhere on earth' }}</b></p>

                <p class="dpos1"><b>Position</b></p>
                <p class="dpos2">{{ $userDetails->position ?? 'player position' }}</b></p>
            </div>
        </div>
    </div>

    <div class="career">
        <div class="card_career1">
            <header class="overallcareer">
                <h3><b>OVERALL CAREER</b></h3>
            </header>
            <div class="grid-container desc">
                <p class="matches1">Matches : </p>
                <p class="matches2">220</p>

                <p class="goals1">Goals : </p>
                <p class="goals2">160</p>

                <p class="assists1">Assist : </p>
                <p class="assists2">80</p>

                <p class="currentteam1">Current Team : </p>
                <p class="currentteam2">Raptors</p>
            </div>
        </div>
        <div class="card_career2">
            <header class="yearcareer">
                <h3><b>THIS YEAR CAREER</b></h3>
            </header>
            <div class="grid-container desc">
                <p class="matches1">Matches : </p>
                <p class="matches2">120</p>

                <p class="goals1">Goals : </p>
                <p class="goals2">60</p>

                <p class="assists1">Assist : </p>
                <p class="assists2">30</p>
            </div>
        </div>

        <br><br>

        <a href="{{ route('editprofile') }}" class="a-tag-btn">Edit Profile</a>
        @php
        if ($userDetails != null && $userDetails->role == "manager") {
        @endphp
                <a href="{{ route('createteam') }}" class="a-tag-btn">Create Team</a>
        @php
            }
        @endphp
        @php
        if ($userDetails != null && $userDetails->role == "player") {
        @endphp
                <a href="{{ route('requestjoin') }}" class="a-tag-btn">Join Team</a>
        @php
            }
        @endphp
    </div>
@endsection
