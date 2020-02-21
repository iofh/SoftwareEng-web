@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> {{ Session::get('message', '') }}
</div>
@endif




<h3 class="text-center">{{$group->title}}</h3>
<p style="text-align:center">{{$group->body}}</p>
<br>

<ul class="list-group py-3 mb-3">
    <table style=" margin-left:auto;margin-right:auto;text-align:center;width:80%">
        <tr>
            <th>Group Name</th>
            <th>User</th>
            <th>User email</th>
        </tr>
        @forelse($group_users as $group_user)
        <tr>
            @if ($group_user->group_id === $group->id)
            <th>{{$group->title}}</th>          
            @foreach($users as $user)
            @if ($group_user->user_id === $user->id)
            <th>{{$user->name}}</th>
            <th>{{$user->email}}</th>
            @endif
            @endforeach
            @endif
        </tr>
        @empty
        <br>
        <h4 class="text-center">No Users Found!</h4>
        @endforelse
    </table>
    <br>
    @auth
    <a href="{{route('groups.edit',$group->id)}}" class="btn btn-primary">Update</a>
    <a href="#" data-toggle="modal" data-target="#delete-modal" class="btn btn-primary">Delete</a>

    @php
$checkIfInGroup=FALSE
@endphp
@foreach($group_users as $group_user)                     
            @if (($group_user->user_id === Auth::user()->id)&&($group_user->group_id === $group->id))
                @php
                    $checkIfInGroup=TRUE
                @endphp
            @endif           
@endforeach

@if ($checkIfInGroup === FALSE)
    <form action="{{route('group_user.joinGroup',$group->id)}}" method="post">
        @csrf
        <div>         
            <input type="hidden" name="group_id" id="group_id" class="form-control {{$errors->has('title') ? 'is-invalid' : '' }}" value="{{$group->id}}">
        </div>
        <button type="submit" class="btn btn-primary"style="width: 100%;">Join Group</button>
    </form>
@else
<a href="{{route('group_user.leaveGroup',$group->id)}}"class="btn btn-primary">Leave Group</a>
@endif
@endauth

</ul>



<div class="clearfix"></div>
<div class="modal fade" id="delete-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Game</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!--This here to show the user if there is 
                    some foreign key connected to the group, the user 
                    will not be able to delete the group. Only when there
                     is no foreign key connected then the user could delete the group-->
            @if ($group_users->isEmpty())
            <div class="modal-body">
                <p>Are you sure!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">Proceed</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
            @else
            <div class="modal-body">
                <p>Can't Delete, There are still users conected to this game.</p>
                <p>Only if there are no users connected to this game then you are able to delete this game</p>
            </div>
            @endif
        </div>
    </div>
</div>

<form method="POST" id="delete-form" action="{{route('groups.destroy',$group->id)}}">
    @csrf
    @method('DELETE')
</form>

@endsection