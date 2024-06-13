@extends('layout/master')

@section('title', 'Add New Event')

@section('content')

    <div class="editprofileform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/player.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="title">
                <h2><b>ADD NEW EVENT</b></h2>
            </header>

            <hr>
            <label for="opponent_team"><b>Opponent team</b></label>
            <br>
            <select name="opponent_team" id="opponent_team" required>
                <option value="">Select team</option>
                @foreach ($opponentTeam as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="match_type"><b>match type</b></label>
            <br>
            <select name="match_type" id="match_type" required>
                <option value="">Select team</option>
                <option value="friendly">Friendly</option>
                <option value="tournament">Tournament</option>
            </select>
            <br><br>

            <label for="court"><b>Court</b></label>
            <br>
            <select name="court" id="court" required>
                <option value="">Select court</option>
                @foreach ($courtList as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }} - {{ $item['location'] }} -
                        {{ $item['type'] }}</option>
                @endforeach
            </select>
            <br><br>

            <label for="date"><b>Date</b></label>
            <input type="date" placeholder="Enter Date" name="date" id="date" required>

            <label for="time"><b>Time</b></label>
            {{-- <input type="text" placeholder="Enter Time" name="time" id="time" required> --}}
            <select name="time" id="time"></select>
            <br><br>
            <label for="referee"><b>Referee</b></label>
            <br>
            <select name="referee" id="referee" required>
                <option value="">Select referee</option>
                @foreach ($getReferees as $item)
                    <option value="{{ $item['user_id'] }}">{{ $item['fullname'] }}</option>
                @endforeach
            </select>

            <br>

            <hr>

            <button type="submit" class="addeventbtn">ADD</button>

        </form>
    </div>

    <script>
        // Get the input element
        const dateInput = document.getElementById('date');

        // Get the current date
        const currentDate = new Date();

        // Format the current date as yyyy-mm-dd (required by the input type="date")
        const formattedCurrentDate = currentDate.toISOString().split('T')[0];

        // Set the "min" attribute to the current date
        dateInput.setAttribute('min', formattedCurrentDate);

        // Get the select element
        const time = document.getElementById('time');

        // Loop to generate options from 00:00 to 23:59
        for (let hour = 0; hour < 24; hour++) {
            for (let minute = 0; minute < 60; minute += 15) {
                // Format the hour and minute as two-digit strings
                const formattedHour = hour.toString().padStart(2, '0');
                const formattedMinute = minute.toString().padStart(2, '0');

                // Create the option element
                const option = document.createElement('option');
                option.text = `${formattedHour}:${formattedMinute}`;
                option.value = `${formattedHour}:${formattedMinute}`;

                // Append the option to the select element
                time.appendChild(option);
            }
        }

        $('form').submit(function(e) {
            e.preventDefault();
            var opponent_team = $('#opponent_team').val();
            var match_type = $('#match_type').val();
            var date = $('#date').val();
            var time = $('#time').val();
            var referee = $('#referee').val();
            var court = $('#court').val();

            var data = {
                'opponent_team': opponent_team,
                'match_type': match_type,
                'date': date,
                'time': time,
                'referee': referee,
                'court': court,
            }

            console.log("data", data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('addNewEventApi') }}",
                data: data,
                success: function(response) {
                    console.log("response", response)
                    alert("API Success")
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX request failed:", textStatus, errorThrown);
                    if (jqXHR.responseJSON) {
                        var errors = jqXHR.responseJSON.errors;
                        // Access specific error messages or parameters that failed
                        console.log("Errors:", errors);
                        alert("An error occurred. Please check the form and try again.");
                    } else {
                        alert("An error occurred. Please try again later.");
                    }
                }
            });
        });
    </script>

@endsection
