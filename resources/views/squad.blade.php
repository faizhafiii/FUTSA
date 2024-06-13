@extends('layout/master')

@section('title', 'Squad')

@section('content')
    <div class="squadlist">
        @php
            $count = 1;
        @endphp
        @foreach ($populatedData as $key => $value)
            <header class="goleiro" style="text-transform: uppercase;">
                <h3><b>{{ $key }}</b></h3>
            </header>
            @foreach ($value as $key2 => $value2)
                <div class="card_squad1" data-value="{{ $value2['player_id'] ?? '1' }}">
                    <div class="grid-container gk1">
                        <h4 class="gk1_name">{{ $value2['player_fullname'] ?? 'John Doe' }}</h4>
                        <p class="gk1_num"><b>{{ $count }}</b></p>
                        <p class="gk1_loc">{{ $value2['player_state'] ?? 'Player State' }}</p>
                    </div>
                </div>
                @php
                    $count++;
                @endphp
            @endforeach
        @endforeach
    </div>

    {{-- {{ var_dump($userDetails->role) }} --}}
    {{-- <br> --}}
    {{-- {{ var_dump($getTeamDetailsRow) }} --}}
    {{-- <br> --}}
    {{-- {{ var_dump($retrievedSquadDetails) }} --}}
    {{-- <br><br> --}}
    {{-- {{ var_dump($populatedData) }} --}}

    <div class="playerprofile">
        <div class="playerimg">
            <img src="{{ asset('/images/player.png') }}" alt="Player Picture" class="playerpic">
        </div>
        <div class="card_playerdesc">
            <header class="grid-container desctitle">
                <h3>PLAYER PROFILE</h3>
            </header>
            <div class="grid-container desc">
                <p class="dname1"><b>Name :</b></p>
                {{-- <p class="dnum1"><b>Squad Number :</b></p> --}}
                <p class="dbirth1"><b>Date of Birth :</b></p>
                <p class="dstate1"><b>State :</b></p>
                <p class="dpos1"><b>Position :</b></p>
                <p class="dcon1"><b>Condition :</b></p>
                <p class="dname2">John Doe</b></p>
                {{-- <p class="dnum2">10</b></p> --}}
                <p class="dbirth2">Jul 02, 2023</b></p>
                <p class="dstate2">Kelantan</b></p>
                <p class="dpos2">Ala</b></p>
                <p class="dcon2">Fit</b></p>
            </div>
        </div>
    </div>

    <script>
        var squadDetailsJSON = @json($retrievedSquadDetails);

        $('.card_squad1').click(function(e) {
            e.preventDefault();
            var playerId = $(this).attr('data-value');
            for (let i = 0; i < squadDetailsJSON.length; i++) {
                // const element = squadDetailsJSON[i];
                if (squadDetailsJSON[i]['player_id'] == playerId) {
                    $('.dname2').html(squadDetailsJSON[i]['player_fullname']);
                    $('.dbirth2').html(formatDate(squadDetailsJSON[i]['player_dob']));
                    $('.dstate2').html(squadDetailsJSON[i]['player_state']);
                    $('.dpos2').html(squadDetailsJSON[i]['player_position']);
                    return
                }

            }
        });

        function formatDate(inputDate) {
            const months = [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];

            // Split the input date string into year, month, and day
            const [year, month, day] = inputDate.split('-');

            // Get the month abbreviation from the months array (0-based index, so subtract 1 from month)
            const monthAbbreviation = months[parseInt(month) - 1];

            // Concatenate the formatted date string
            const formattedDate = `${monthAbbreviation} ${parseInt(day)}, ${year}`;

            return formattedDate;
        }

        $(window).on("load", function() {
            // Get the first element with class name 'card'
            const firstCardElement = document.querySelector('.card_squad1');

            // Do something with the selected element
            if (firstCardElement) {
                // Click the first card element
                firstCardElement.click();
                // You can access properties and perform actions on the element here.
            } else {
                console.log("No element with class 'card' found.");
            }
        });
    </script>
@endsection
