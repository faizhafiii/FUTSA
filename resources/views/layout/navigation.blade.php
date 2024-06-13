<div class="topnav" id="myTopnav">
    <div class="logo">
        {{-- <img src="/images/logo1.png" alt="Logo"> --}}
        <img src="{{ asset('images/logo1.png') }}" alt="Logo">
    </div>
    <a href="{{ route('home') }}">Team Overview</a>
    <a href="{{ route('squad') }}">Squad</a>
    <a href="{{ route('schedule') }}">Schedule</a>
    <a href="{{ route('results') }}">Results</a>
    <a href="{{ route('stats') }}">Stats</a>
    <a href="{{ route('profile') }}">Profile</a>
    <a href="javascript:void(0);" onclick="logout()">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
    {{-- <div class="search">
        <input type="text" placeholder="Search">
        <button type="search_btn">
            <i class="fa fa-search"></i>
        </button>
    </div> --}}
    <div class="">
        <a href="{{ route('approve') }}">
            <h3>{{ $userDetails->fullname ?? 'John Doe' }}</h3>
        </a>
    </div>
</div>

<div class="teamcontainer">
    <div class="clublogo">
        <img src="{{ asset('images/raptorsbg.png') }}" alt="ClubLogo" class="resizable-image">
    </div>
    {{-- <div class="clubdetail">
        <h1>RAPTORS</h1>
        <h2>UTP PERAK</h2>
    </div> --}}
</div>
