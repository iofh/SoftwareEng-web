@extends('layouts.app')
@section('content')
    <div>
    <form action="{{route('games.search')}}" method="GET" role="search">
        {{ csrf_field() }}
        <div class="form-group">
            <span class="input-group-prepend">
                <input type="search" class="form-control" name="search" placeholder="Search Games">
            
                <button type="submit" class="btn btn-default">Search</button>
                <span class="glyphicon glyphicon-search"></span>
            </span>
        </div>
    </form>

    @if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif

@if(Session::has('delsuccess'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif

@if(Session::has('scoresuccess'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif


    </div>
    <h2 class="text-center">All Games</h2>
    <ul class="list-group py-3 mb-3">
        @forelse($games as $game)
            <li class="list-group-item my-2">
                <div>
                    <img src="{{ asset('storage/' . $game->image) }}" alt="" class="img-thumbnail">
                </div>
                <h5>Game: {{$game->title}}</h5>
                <p>Introduction: {{str_limit($game->body,20)}}</p>

                <small class="float-right">{{$game->created_at}}</small>
                <a href="{{route('games.show',$game->id)}}" class="btn btn-primary float-left">Read More</a>
            </li>
        @empty
            <h4 class="text-center">No Games Found!</h4>
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{$games->links()}}
    </div>
@endsection