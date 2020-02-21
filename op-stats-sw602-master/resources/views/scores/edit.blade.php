@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit Score  </h3>
    <form action="{{route('scores.update',$score->id)}}" method="post" id="scoreForm">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="score">Score</label>
            <input type="text" name="score" id="score" class="form-control {{$errors->has('score') ? 'is-invalid' : '' }}" value="{{old('score')? : $score->score}}" placeholder="Enter Score">
            @if($errors->has('score'))
                <span class="invalid-feedback">
                    {{$errors->first('score')}}
                </span>
            @endif
        </div>           
        <button type="submit" class="btn btn-primary">Update Score</button>
    </form>
@endsection