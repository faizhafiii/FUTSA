@extends('layout/master')

@section('title', 'Register')

@section('content')

    <div class="registerform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/futsa.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="registertitle">
                <h2><b>REGISTER</b></h2>
            </header>
            <hr>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" pattern="^[^@\s]+@([^@\s]+\.)+[^@\s]+$" placeholder="Enter Email" name="email"
                    id="email" required>

                <label for="uname"><b>Username</b></label>
                <input type="text" pattern="^[^\s]+$" placeholder="Enter Username" name="uname" id="uname" required
                    title="Username should not contain any spaces.">

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required pattern=".{6,}"
                    title="minimum of 6 characters for password">

                <label for="psw_confirmation"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw_confirmation" id="psw_confirmation"
                    oninput="validatePassword()" required>
                <span id="confirmPasswordValidation"></span>

                <button type="submit" class="registerbtn">Register</button>

            </div>
            <div class="container2 signin" style="background-color:#f1f1f1; padding: 16px; border-radius: 8px;">
                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a>.</p>
            </div>
        </form>
    </div>

    <script>
        var passMatchStr = "Passwords match buleh register"
        var passNotMatchStr = "Passwords do not match xleh register"
        $('form').submit(function(e) {
            e.preventDefault();
            // alert('form submitted')

            var email = $('#email').val();
            var uname = $('#uname').val();
            var psw = $('#psw').val();
            var psw_confirmation = $('#psw_confirmation').val();

            // alert("email: " + email + "; username: " + uname + "; password: " + psw)

            var data = {
                'email': email,
                'uname': uname,
                'psw': psw,
                'psw_confirmation': psw_confirmation,
            }

            console.log("data", data)

            var confirmPassMsg = $("#confirmPasswordValidation").html();

            if (confirmPassMsg == passMatchStr) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('userRegister') }}",
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
            }

        });

        function validatePassword() {
            var password = document.getElementById("psw").value;
            var confirmPassword = document.getElementById("psw_confirmation").value;
            var validationMessage = document.getElementById("confirmPasswordValidation");

            if (password === confirmPassword) {
                validationMessage.textContent = passMatchStr;
                validationMessage.style.color = "green";
            } else {
                validationMessage.textContent = passNotMatchStr;
                validationMessage.style.color = "red";
            }
        }
    </script>

@endsection
