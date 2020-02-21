@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-3">
            <h2 class="text-center">All Games</h2>
            <ul class="list-group py-3 mb-3">
                <!--This area shows the game-->
                @forelse($games as $game)
                    <li class="list-group-item my-2">             
                        <div>
                            <img src="{{ asset('storage/' . $game->image) }}" alt="" class="img-thumbnail">
                        </div>
                        <h5>Game: {{$game->title}}</h5>
                        <p>Introduction: {{str_limit($game->body,20)}}</p>              
                        @if(isset($game->genre->genre))
                        <p>Genre: {{$game->genre->genre}}</p>

                    @endif     
                        <a href="{{route('games.show',$game->id)}}" class="btn btn-primary float-left">Read More</a>
                    </li>
                @empty
                <!--if there is no game in the database then this will be show instead-->
                    <h4 class="text-center">No Games Found!</h4>
                @endforelse
            </ul>
        </div>    


        <div class="col-md-3"><!--This area shows the users-->
                <h2 class="text-center">All Users</h2>
                <ul class="list-group py-3 mb-3">
                    @forelse($users as $user)
                        <li class="list-group-item my-2">
                            <h5>User: {{$user->name}}</h5>
                            @auth
                            <h5>User: {{$user->email}}</h5>
                            @endauth
                        </li>
                    @empty<!--if there is no user in the database then this will be show instead-->
                        <h4 class="text-center">No Users Found!</h4>
                    @endforelse
                </ul>
        </div> 
        <div class="col-md-3"><!--This area shows the scores-->
        <h2 class="text-center">All Scores</h2>
        <ul class="list-group py-3 mb-3">
        @forelse($scores as $score)
                    <li class="list-group-item my-2">
                        @foreach ($games as $game)
                            @if ($score->game_id === $game->id)
                            
                            <h5>Game Title : {{$game->title}}</h5>                 
                            @endif
                        @endforeach   
                        <p>Score : {{$score->score}}</p>
                        @foreach ($users as $user)
                            @if ($score->user_id === $user->id)
                            <p>Created By : {{$user->name}}</p>                  
                            @endif
                        @endforeach                           
                    </li>
                @empty<!--if there is no scores in the database then this will be show instead-->
                    <h4 class="text-center">No Scores Found!</h4>
                @endforelse
        </ul>
        </div> 

        <div class="col-md-3">
            <h2 class="text-center">Popular games</h2>
            @php
        $i =0
        @endphp
    @foreach ($scores as $score)
        @if($score->game_id === 2)
        @php
        $i++
        @endphp
        @endif
    @endforeach
            <ul class="list-group py-3 mb-3">
                        @foreach ($popgames as $game)
                        <li class="list-group-item my-2">                    
                            <h5>Game Title : {{$game->title}}</h5>                 
                            @endforeach                   
                        </li>
            </ul>
        </div> 
    </div>
</div>
@endsection