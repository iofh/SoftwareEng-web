@extends('layouts.app')
@section('content')
    <h2 class="text-center">{{$games[0]->title}}</h2>
        <ul class="list-group py-3 mb-3">
            @forelse($scores as $score)
                <li class="list-group-item my-2">
                    @foreach ($games as $game)
                        @if ($score->game_id === $game->id)
                        <h5>Game Title : {{$game->title}}</h5>                 
                        @endif
                    @endforeach   
                    <p>Scores : {{$score->score}}</p>
                    @foreach ($users as $user)
                        @if ($score->user_id === $user->id)
                        <p>Created By : {{$user->name}}</p>                  
                        @endif
                    @endforeach       
                  
                </li>
            @empty
                <h4 class="text-center">No Scores Found!</h4>
            @endforelse
        </ul>
    <div class="d-flex justify-content-center">
       
    </div>
@endsection