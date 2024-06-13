@extends('layout/master')

@section('title', 'Squad')

@section('content')

@php
    if ($userDetails->role == "manager") {
@endphp
        <br><br>
        <div class="btnadd">
            <a class="button add" href="{{ route('addnewevent')}}"><b>+ ADD NEW</b></a>
        </div>   
@php
    }
@endphp
{{-- {{ print '<pre>' . print_r($matchesByMonthYear, true) . '</pre>' }} --}}
<div class="months">
    @if (count($matchesByMonthYear))
        @foreach ($matchesByMonthYear as $item => $value)    
            <header class="month">
                <h4 class="">{{$item}}</h4>
            </header>
            @foreach ($value as $item2 => $value2)
                <div class="card-container">
                    <div class="card">
                        <div class="">
                            <h4 class="">{{$value2['hometeam']}} vs {{$value2['awayteam']}}</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="">
                            @php
                                $dateString = $value2['datetime'] ?? '2020-08-03 00:00';
                                $dateTime = new DateTime($dateString);
                                $formattedDate = $dateTime->format('F d, Y | H:i');
                            @endphp
                            <p class="">{{$formattedDate}}</p>
                            <p class="">{{$value2['location']}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @else
        <div class="card-container">
            <div class="card">
                <div class="">
                    <h4 class="">No Match Scheduled</h4>
                </div>
            </div>
        </div>
    @endif

    {{-- <header class="month">
        <h4 class="">May</h4>
    </header>
    <div class="card-container">
        <div class="card">
            <div class="">
                <h4 class="">Vs Patta</h4>
            </div>
        </div>
        <div class="card">
            <div class="">
                <p class="">5th - 22:30</p>
                <p class="">V1 Court UTP</p>
            </div>
        </div>
    </div>

    <header class="month">
        <h4 class="">June</h4>
    </header>
    <div class="card-container">
        <div class="card">
            <div class="">
                <h4 class="">Vs Rasta</h4>
            </div>
        </div>
        <div class="card">
            <div class="">
                <p class="">21st - 22:00</p>
                <p class="">V1 Court UTP</p>
            </div>
        </div>
    </div>
    <div class="card-container">
        <div class="card">
            <div class="">
                <h4 class="">Vs Bragas</h4>
            </div>
        </div>
        <div class="card">
            <div class="">
                <p class="">10th - 22:30</p>
                <p class="">Sport Complex UTP</p>
            </div>
        </div>
    </div> --}}
</div>
@endsection