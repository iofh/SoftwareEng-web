@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif

@if(Session::has('scoredelsuccess'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif


<div class="row">
<div class="col-md-4">
    <img src="{{ asset('storage/' . $game->image) }}" alt=""  class="img-responsive" style="border-radius: 50%; width: 200px;  height: 200px;margin-left: 20px;margin-right: 20px;">
    </div>
    <div class="col-md-4">
    <h3 class="text-center">Title: {{$game->title}}</h3>
    <p style="text-align:center">Description: {{$game->body}}</p>
    <p style="text-align:center">Genre: {{$game->genre->genre}}</p>
    </div>
    <div class="col-md-4">
    @auth
    <div class="float-right">
        <div class="row">
        <a href="{{route('games.edit',$game->id)}}" class="btn btn-primary">Update</a>
        </div>
        <div class="row">
        <a href="#" data-toggle="modal" data-target="#delete-modal" class="btn btn-primary">Delete</a> 
        </div> 
        <div class="row">  
        <a href="{{route('scores.create',$game)}}" class="btn btn-primary">Add NewScore</a>
        </div>
    </div>
    </div>
    @endauth
    
</div>


<div style="border: solid;width: 100%;">
<br>
<ul class="list-group py-3 mb-3">
    <table style=" margin-left:auto;margin-right:auto;text-align:center;width:80%">
    <h3 class="text-center">Scores</h3>
        <tr>
            <th>Game Name</th>
            <th>Scores</th>
            <th>Create By</th>
            <th>Detail</th>
        </tr>
        @forelse($scores as $score)
        <tr>
            @if ($score->game_id === $game->id)
            <td>{{$game->title}}</td>
            @endif
            <td>{{$score->score}}</td>

            @foreach ($users as $user)
				@if ($score->user_id === $user->id)
				<td>{{$user->name}}</td>
				@endif                       
            @endforeach
			<td><a href="{{route('scores.show',$score->id)}}"class="btn btn-primary float-middle">Read More</a></td>

        </tr>
        @empty
        <br>
        <h4 class="text-center">No Scores Found!</h4>
        @endforelse
    </table><br>

    
</ul>
</div>

<div class="clearfix"></div>
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($scores->isEmpty())
            <div class="modal-body">
                <p>Are you sure!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
            @else
            <div class="modal-body">
                <p>Can't Delete, There are still scores conected to this game.</p>
                <p>Only if there are no scores connected to this game then you are able to delete this game</p>
            </div>
            @endif
        </div>
    </div>
</div>

<form method="POST" id="delete-form" action="{{route('games.destroy',$game->id)}}">
    @csrf
    @method('DELETE')
</form>


@endsection