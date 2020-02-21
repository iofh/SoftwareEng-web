@extends('layouts.app')
@section('content')

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

<h2 class="text-center">All Groups</h2>
            @if(Session::get('status'))
                <div class="alert alert-success"> {{ Session::get('status') }}</div>
            @endif
    <ul class="list-group py-3 mb-3">
        @forelse($groups as $group)
            <li class="list-group-item my-2">
                <h5>Group: {{$group->title}}</h5>
                <p>Introduction: {{str_limit($group->body,20)}}</p>
                <small class="float-right">{{$group->created_at->diffForHumans()}}</small>
                <a href="{{route('groups.show',$group->id)}}" class="btn btn-primary float-left">Read More</a>
            </li>
        @empty
            <h4 class="text-center">No Groups Found!</h4>
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{$groups->links()}}
    </div>
@endsection