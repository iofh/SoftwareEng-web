@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create Scores</h3>
    <form action="{{route('scores.store')}}" method="post" id="scoreForm">
        @csrf
        <div class="form-group">
            <label for="score">Score</label>
            <input type="text" name="score" id="score" class="form-control {{$errors->has('score') ? 'is-invalid' : '' }}" value="{{old('score')}}" placeholder="Enter Score">
            @if($errors->has('score'))
                <span class="invalid-feedback">
                    {{$errors->first('score')}}
                </span>
            @endif
        </div>
        

            <!--<input list="scores" name="game_id">
            <datalist id="scores">
            @forelse($games as $game)
                <option value="{{$game->id}}">{{$game->title}}<option>
                @empty
                <h4 class="text-center">No Games Found!</h4>
                @endforelse
            </datalist>-->
            

            
            <select id="scores" name="game_id" form="scoreForm">
            @forelse($games as $game)
                <option value="{{$game->id}}">{{$game->title}}</option>
                @empty
                <h4 class="text-center">No Games Found!</h4>
                @endforelse
            </select>




        <!--<div class="form-group">
            <label for="body">Game Score</label>
            <textarea name="body" id="body" rows="4" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" placeholder="Enter Short Game Description">{{old('body')}}</textarea>
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('body')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>-->

        <button type="submit" class="btn btn-primary float-right">Create Score</button>
    </form>
@endsection
