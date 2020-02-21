@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit Game</h3>
    <form action="{{route('games.update',$game->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Game Title</label>
            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') ? : $game->title }}" placeholder="Enter Title">
            @if($errors->has('title')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('title')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="body">Game Description</label>
            <textarea name="body" id="body" rows="4" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Enter Game Description">{{ old('body') ? : $game->body }}</textarea>
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('body')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group d-flex flex-column" >         
            <label form="image">Image</label>
            <input type="file" name="image" class="py-3">
            
            {{$errors->first('image')}}            
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection