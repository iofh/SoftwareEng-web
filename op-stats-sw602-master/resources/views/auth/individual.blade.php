@extends('layouts.app')
@section('content')

<div>
    <div class="row">
        <img src="{{ asset('storage/' . $user->image) }}" alt="Responsive Image"    class="img-responsive" style="border-radius: 50%; width: 200px;  height: 200px;margin-left: 20px;margin-right: 20px;">
    </div>
          
        <div class="row">   
            <h3 class="float-lg-left">Display Name: {{$user->name}}</h3>     
            <h3 class="text-center"> </h3>
        </div>
        @auth<!--Only show this area when the user in logged in so that their email wont be leaked-->
        <div class="row">   
            <h3 class="float-lg-left">Email: {{$user->email}}</h3>
            <h3 style="text-align:center"> </h3>      
        </div>
        @endauth
        <!--Only show this area when the user in logged in-->
        <div class="row">
        @auth
            @if ($user->id !=  Auth::user()->id )
                <a href="{{route('auth.requestBan',$user->id)}}" class="btn btn-primary float-left">Request Ban</a>
                <a href="{{route('auth.unBan',$user->id)}}" class="btn btn-primary float-left">Unban</a>
            @else
                <a href="{{route('auth.edit',$user->id)}}" class="btn btn-primary float-left">Edit Profile</a>
            @endif
        @endauth
        </div>
    
</div>
@endsection