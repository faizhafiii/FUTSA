@extends('layout/master')

@section('title', 'Join Team')

@section('content')

    <div class="editprofileform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/futsa.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="title">
                <h2><b>JOIN TEAM</b></h2>
            </header>

            <hr>
            {{-- <label for="teamteam"><b>Team Name</b></label>
            <input type="text" placeholder="Enter Team Name" name="team" id="team" required> --}}

            <label for="team"><b>Team name</b></label>
            <select name="team" id="team">
                <option value="">Select team</option>
                @foreach ($teamDetails as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endforeach
            </select>

            {{-- <label for="location"><b>Location</b></label>
            <input type="text" placeholder="Enter Team Location" name="location" id="location" required> --}}


            <br>

            <hr>

            <button type="submit" class="updatebtn">REQUEST</button>

        </form>
    </div>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            // alert('form submitted')

            var teamid = $('#team').val();

            var data = {
                'teamid': teamid,
            }

            console.log("data", data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('userrequesttojointeamapi') }}",
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
