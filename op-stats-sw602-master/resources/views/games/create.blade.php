@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create Games</h3>
    <form action="{{route('games.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Game Title</label>
            <input type="text" name="title" id="title" class="form-control {{$errors->has('title') ? 'is-invalid' : '' }}" value="{{old('title')}}" placeholder="Enter Game Title">
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{$errors->first('title')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="body">Game Description</label>
            <textarea name="body" id="body" rows="4" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" placeholder="Enter Short Game Description">{{old('body')}}</textarea>
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
        <div class="form-group">
        <label>Select a genre:</label>
    <select name="genre" class="form-control {{$errors->has('genre') ? 'is-invalid' : '' }}" style="width:350px">
    <option value="">--- Select genre ---</option>
    @foreach ($genres as $genre => $value)
    <option value="{{ $genre }}">{{ $value->genre }}</option>
    @endforeach
    </select>
    @if($errors->has('genre'))
            <span class="invalid-feedback">
                    {{$errors->first('genre')}}
                </span>
    @endif
    </div>
        <button type="submit" class="btn btn-primary">Create Game</button>
    </form>
@endsection