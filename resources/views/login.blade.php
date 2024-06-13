@extends('layout/master')

@section('title', 'Login')

@section('content')

    <div class="loginform">
        <form class="modal-content animate">
            <div class="imgcontainer">
                <img src="{{ asset('/images/futsa.png') }}" alt="Avatar" class="avatar">
            </div>

            <header class="logintitle">
                <h2><b>LOGIN</b></h2>
            </header>
            <hr>

            <div class="container">
                <label for="email"><b>Email</b></label>
                <input type="email" pattern="^[^@\s]+@([^@\s]+\.)+[^@\s]+$" placeholder="Enter Email" name="email"
                    id="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

                <button type="submit">Login</button>
                {{-- <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label> --}}
            </div>

            <div class="container2" style="background-color:#f1f1f1; padding: 16px; border-radius: 8px;">
                <a class="createacc" href="{{ route('register') }}">Create an account</a>
                <p class="psw"><a class="forgotpass" href="{{ route('forgot_password') }}">Forgot password?</a></p>
            </div>
        </form>
    </div>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            var email = $("#email").val();
            var psw = $("#psw").val();

            var data = {
                'email': email,
                'password': psw,
            }

            console.log("data", data);

            if (email != "" && psw != "") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('userLogin') }}",
                    data: data,
                    success: function(response) {
                        console.log("response", response)
                        window.location.href = "{{ route('home') }}";
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
    </script>

@endsection
