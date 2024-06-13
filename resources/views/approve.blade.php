@extends('layout/master')

@section('title', 'Player Request')

@section('content')

    <div class="notification">
        <header class="title">
            <h2>NOTIFICATION</h2>
        </header>
        {{-- {{ var_dump($notiDetailsUserDetails) }} --}}

        {{-- {{ print '<pre>' . print_r($notiDetailsUserDetails, true) . '</pre>' }} --}}
        <br>
        @if (count($notiDetailsUserDetails) >= 1)
            @foreach ($notiDetailsUserDetails as $item => $value)
                {{-- @if (isset($value['match_proposal']) && is_array($value['match_proposal']) && count($value['match_proposal']) > 0) --}}
                @if (isset($value['match_proposal']))
                    @foreach ($value as $item2 => $value2)
                        <p>Team <b>{{ $value2['name'] }}</b> has invited you to a
                            <b>{{ $value2['notification_details'][0]['match_type'] }}</b> match.
                            <br>
                            <br>
                            <b>Date:</b> {{ $value2['notification_details'][0]['date'] }}
                            <br>
                            <b>Time:</b> {{ $value2['notification_details'][0]['time'] }}
                            <br>
                            <b>Court:</b> {{ $value2['court_name'] }}
                        </p>
                        <button type="submit" class="approvebtn" data-type="approve" data-noti-type="match_proposal"
                            data-value="{{ $value2['notification_details'][0]['notification_row_id'] }}">Approve</button>
                        <button type="submit" class="rejectbtn" data-type="reject" data-noti-type="match_proposal"
                            data-value="{{ $value2['notification_details'][0]['notification_row_id'] }}">Reject</button>
                    @endforeach
                @elseif (isset($value['join_team_request']) &&
                        is_array($value['join_team_request']) &&
                        count($value['join_team_request']) > 0)
                    @foreach ($value as $item2 => $value2)
                        <div>
                            <p><b>{{ $value2['fullname'] }}</b> has requested to join your team. You may choose either to
                                approve
                                or
                                reject.</p>
                            <p>Their position is <b>{{ $value2['position'] }}</b> and they are from
                                <b>{{ $value2['state'] }}</b>
                            </p>
                            <button type="submit" class="approvebtn" data-type="approve" data-noti-type="join_team_request"
                                data-value="{{ $value2['id'] }}">Approve</button>
                            <button type="submit" class="rejectbtn" data-type="reject" data-noti-type="join_team_request"
                                data-value="{{ $value2['id'] }}">Reject</button>
                        </div>
                    @endforeach
                @endif
                <br><br>
            @endforeach
        @else
            <div>
                <p>no notification</p>
            </div>
        @endif
        {{-- <p>Player 1 has requested to join your team. You may choose either to approve or reject.</p>
        <br>
        <button type="submit" class="approvebtn">Approve</button>
        <button type="submit" class="rejectbtn">Reject</button> --}}
    </div>

    <script>
        $("button").click(function(e) {
            e.preventDefault();
            console.log("this attr data-type =>", $(this).attr('data-type'));
            console.log("this attr data-value =>", $(this).attr('data-value'));

            var playerId = $(this).attr('data-value')
            var btnClickType = $(this).attr('data-type')
            var notiType = $(this).attr('data-noti-type')

            var data = {
                'playerId': playerId,
                'btnClickType': btnClickType,
                'notiType': notiType,
            }

            console.log("data", data)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{{ route('applicationApprovalApi') }}",
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
