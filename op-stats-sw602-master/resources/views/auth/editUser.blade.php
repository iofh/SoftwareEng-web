@extends('layouts.app')
@section('content')
    <h3 class="text-center">Edit Profile</h3>
    <form action="{{route('auth.update',$user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') ? : $user->name }}" placeholder="Enter Name">
            @if($errors->has('name')) {{-- <-check if we have a validation error --}}
                <span class="invalid-feedback">
                    {{$errors->first('name')}} {{-- <- Display the First validation error --}}
                </span>
            @endif
        </div>
        <div class="form-group d-flex flex-column" >         
            <label form="image">Profile Image</label>
            <input type="file" name="image" class="py-3">           
            {{$errors->first('image')}}            
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection