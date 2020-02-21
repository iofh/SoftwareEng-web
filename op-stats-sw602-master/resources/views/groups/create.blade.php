@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create Group</h3>
    <form action="{{route('groups.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Group Name</label>
            <input type="text" name="title" id="title" class="form-control {{$errors->has('title') ? 'is-invalid' : '' }}" value="{{old('title')}}" placeholder="Enter Group Name">
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{$errors->first('title')}}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="body">Group Description</label>
            <textarea name="body" id="body" rows="4" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" placeholder="Enter Short Description">{{old('body')}}</textarea>
            @if($errors->has('body')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('body')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Create Group</button>
    </form>
@endsection