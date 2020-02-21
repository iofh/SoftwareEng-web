@extends('layouts.app')
@section('content')
<h3 class="text-center">Edit Group</h3>
<form action="{{route('groups.update',$group->id)}}" method="post">
@csrf
@method('PUT')
<div class="form-group">
<label for="title">Group Title</label>
<input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') ? : $group->title }}" placeholder="Enter Title">
@if($errors->has('title')) {{-- <-check if we have a validation error --}}
<span class="invalid-feedback">
{{$errors->first('title')}} {{-- <- Display the First validation error --}}
</span>
@endif
</div>
<div class="form-group">
<label for="body">Group Description</label>
<textarea name="body" id="body" rows="4" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Enter Group Description">{{ old('body') ? : $group->body }}</textarea>
@if($errors->has('body')) {{-- <-check if we have a validation error --}}
<span class="invalid-feedback">
{{$errors->first('body')}} {{-- <- Display the First validation error --}}
</span>
@endif
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection