@extends('layouts.app')
@section('content')
    <h2 class="text-center">Users</h2>
        <ul class="list-group py-3 mb-3">
        
            @if(!empty($successMsg))
                <div class="alert alert-success"> {{ $successMsg }}</div>
            @endif

            @forelse($users as $user)
                <li class="list-group-item my-2">
                <p> {{$user->name}}</p>
                @auth
                <p> {{$user->email}}</p>
                @endauth
                <a href="{{route('auth.individual',$user->id)}}" class="btn btn-primary float-left">Profile</a>
                </li>
            @empty
                <h4 class="text-center">No Users Found!</h4>
            @endforelse
        </ul>
    <div class="d-flex justify-content-center">
       
    </div>
@endsection