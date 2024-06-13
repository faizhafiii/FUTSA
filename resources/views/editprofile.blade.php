@extends('layout/master')

@section('title', 'Edit Profile')

@section('content')

    <div class="editprofileform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/player.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="title">
                <h2><b>EDIT PROFILE</b></h2>
            </header>

            <hr>
            <label for="fullname"><b>Fullname</b></label>
            <input type="text" placeholder="Enter Fullname" name="fullname" id="fullname" required>

            <label for="dob"><b>Date of Birth</b></label>
            <input type="date" placeholder="Enter Date of Birth" name="dob" id="dob" required>

            <label for="role"><b>Role</b></label>
            <select name="role" id="role">
                <option value="player">Player</option>
                <option value="manager">Manager</option>
                <option value="referee">Referee</option>
            </select>
            <br>

            <label for="state"><b>State</b></label>
            <select name="state" id="state">
                <option value="">Select a state</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Pulau Pinang">Pulau Pinang</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="W.P. Kuala Lumpur">W.P. Kuala Lumpur</option>
                <option value="W.P. Labuan">W.P. Labuan</option>
                <option value="W.P. Putrajaya">W.P. Putrajaya</option>
            </select>
            <br>

            <label for="position"><b>Position</b></label>
            <select name="position" id="position">
                <option value="goleiro">Goleiro</option>
                <option value="fixo">Fixo</option>
                <option value="ala">Ala</option>
                <option value="pivot">Pivot</option>
            </select>
            <br>

            <hr>

            <button type="submit" class="updatebtn">UPDATE</button>

        </form>
    </div>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            // alert('form submitted')

            var fullname = $('#fullname').val();
            var dob = $('#dob').val();
            var role = $('#role').val();
            var state = $('#state').val();
            var position = $('#position').val();


            var data = {
                'fullname': fullname,
                'dob': dob,
                'role': role,
                'state': state,
                'position': position,
            }

            console.log("data", data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('userEditProfile') }}",
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
