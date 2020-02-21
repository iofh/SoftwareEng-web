<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}" >
            Games Tracker
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('pages.index')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pages.about')}}" class="nav-link">About</a>
                </li>
                
            </ul>

            <!-- Right Side Of Navbar -->
           
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a href="{{route('auth.showUsers')}}" class="nav-link">View Users</a>
                </li>        
                <!-- DropDown for games -->       
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Games <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('games.index')}}" class="dropdown-item">View Games</a>
                        @auth              
                            <a href="{{route('games.create')}}" class="dropdown-item">Add New Game</a>                   
                        @endauth                    
                    </div>
                </li>
                <!-- DropDown for Groups -->     
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Groups <span class="caret"></span>
                    </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('groups.index')}}" class="dropdown-item">View Groups</a>
                        @auth                      
                            <a href="{{route('groups.create')}}" class="dropdown-item">Add New Groups</a>                       
                        @endauth                       
                        </div>
                </li>
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @php
                        $id =  Auth::user()->id 
                        @endphp
                        <a href="{{route('auth.individual', $id)}}" class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>