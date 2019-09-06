<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
	
	<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand"
               href="#">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarsExample05"
                    aria-controls="navbarsExample05"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav mr-auto">
                    {{--          <li class="nav-item active">--}}
	                {{--            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>--}}
	                {{--          </li>--}}
	                {{--	        <li class="nav-item">--}}
	                {{--            <a class="nav-link" href="#">Link</a>--}}
	                {{--          </li>--}}
	                {{--          <li class="nav-item dropdown">--}}
	                {{--            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>--}}
	                {{--            <div class="dropdown-menu" aria-labelledby="dropdown05">--}}
	                {{--              <a class="dropdown-item" href="#">Action</a>--}}
	                {{--              <a class="dropdown-item" href="#">Another action</a>--}}
	                {{--              <a class="dropdown-item" href="#">Something else here</a>--}}
	                {{--            </div>--}}
	                {{--          </li>--}}
                </ul>
	            @auth('admin')
		            <div class="dropdown">
                      <button class="btn px-sm-0 dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                          {{auth('admin')->user()->name}}
                      </button>
                      <div class="dropdown-menu dropdown-menu-lg-right"
                           aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item"
                             href="{{route('admin.profile')}}]}">Profile</a>
                          <a class="dropdown-item"
                             href="{{route('admin.clients')}}">Clients</a>
                          <a class="dropdown-item"
                             href="{{ route('logout') }}"
                             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                          <form id="logout-form"
                                action="{{ route('logout') }}"
                                method="POST"
                                style="display: none;">
                              {{ csrf_field() }}
                          </form>
                      </div>
                  </div>
	            @endauth
            </div>
        </nav>
	
	    @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
