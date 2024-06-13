@extends('layout/master')

@section('title', 'Forgot Password')

@section('content')

    <div class="forgotpassform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/futsa.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="forgotpasstitle">
                <h2><b>Reset Password</b></h2>
                <p>Enter email and new password</p>
            </header>
            <hr>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" pattern="^[^@\s]+@([^@\s]+\.)+[^@\s]+$" placeholder="Enter Email" name="email"
                    id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required pattern=".{6,}"
                    title="minimum of 6 characters for password">

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw_confirmation" id="psw_confirmation"
                    oninput="validatePassword()" required>
                <span id="confirmPasswordValidation"></span>

                <button type="submit">Save</button>
                <label>

            </div>

            <div class="container2" style="background-color:#f1f1f1; padding: 16px; border-radius: 8px;">
                <p class="psw">Back to <a class="forgotpass" href="{{ route('login') }}">login</a></p>
            </div>

        </form>
    </div>

    <script>
        var passMatchStr = "Passwords match"
        var passNotMatchStr = "Passwords do not match"
        $('form').submit(function(e) {
            e.preventDefault();

            var email = $("#email").val();
            var psw = $("#psw").val();
            var psw_confirmation = $("#psw_confirmation").val();

            var data = {
                'email': email,
                'psw': psw,
                'psw_confirmation': psw_confirmation,
            }

            console.log("data", data);

            var confirmPassMsg = $("#confirmPasswordValidation").html();

            if (confirmPassMsg == passMatchStr) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('userForgotPassword') }}",
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
