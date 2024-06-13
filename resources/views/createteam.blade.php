@extends('layout/master')

@section('title', 'Create Team')

@section('content')

    <div class="editprofileform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/player.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="title">
                <h2><b>CREATE TEAM</b></h2>
            </header>

            <hr>
            <label for="name"><b>Team Name</b></label>
            <input type="text" placeholder="Enter Team Name" name="name" id="name" required>

            <label for="location"><b>Location</b></label>
            <input type="text" placeholder="Enter Team Location" name="location" id="location" required>

            {{-- <label for="squad"><b>Player 1 Name</b></label>
            <input type="text" placeholder="Enter Player 1 Name" name="squad" id="squad" required>
            <label for="contact"><b>Player 1 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact" required>
            <br>
            <label for="jerseynumber"><b>Player 1 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber" required>
            <br>
            <br>
            <label for="squad"><b>Player 2 Name</b></label>
            <input type="text" placeholder="Enter Player 2 Name" name="squad" id="squad" required>
            <label for="contact"><b>Player 2 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact" required>
            <br>
            <label for="jerseynumber"><b>Player 2 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber" required>
            <br>
            <br>
            <label for="squad"><b>Player 3 Name</b></label>
            <input type="text" placeholder="Enter Player 3 Name" name="squad" id="squad" required>
            <label for="contact"><b>Player 3 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact" required>
            <br>
            <label for="jerseynumber"><b>Player 3 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber" required>
            <br>
            <br>
            <label for="squad"><b>Player 4 Name</b></label>
            <input type="text" placeholder="Enter Player 4 Name" name="squad" id="squad" required>
            <label for="contact"><b>Player 4 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact" required>
            <br>
            <label for="jerseynumber"><b>Player 4 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber" required>
            <br>
            <br>
            <label for="squad"><b>Player 5 Name</b></label>
            <input type="text" placeholder="Enter Player 5 Name" name="squad" id="squad">
            <label for="contact"><b>Player 5 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact" required>
            <br>
            <label for="jerseynumber"><b>Player 5 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber" required>
            <br>
            <br>
            <label for="squad"><b>Player 6 Name</b></label>
            <input type="text" placeholder="Enter Player 6 Name" name="squad" id="squad">
            <label for="contact"><b>Player 6 Contact</b></label>
            <input type="integer" placeholder="Enter Player 1 Contact number" name="contact" id="contact">
            <br>
            <label for="jerseynumber"><b>Player 6 Squad Number</b></label>
            <input type="integer" placeholder="Enter Player 1 Jersey Number" name="jerseynumber" id="jerseynumber"> --}}

            <br>

            <hr>

            <button type="submit" class="createbtn">CREATE</button>

        </form>
    </div>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            // alert('form submitted')

            var name = $('#name').val();
            var location = $('#location').val();

            var data = {
                'name': name,
                'location': location,
            }

            console.log("data", data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('userCreateTeam') }}",
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
