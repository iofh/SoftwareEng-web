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
    </div>
    <h2 class="text-center">Search result "{{$search}}"</h2>
    <ul class="list-group py-3 mb-3">
        @forelse($games as $game)            
                <li class="list-group-item my-2">
                    <div>
                        <img src="{{ asset('storage/' . $game->image) }}" alt="" class="img-thumbnail">
                    </div>
                    <h5>{{$game->title}}</h5>
                    <p>{{str_limit($game->body,20)}}</p>                 
                    <a href="{{route('games.show',$game->id)}}">Read More</a>
                </li>         
        @empty
            <h4 class="text-center">No Games Found!</h4>  
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{$games->links()}}
    </div>
@endsection