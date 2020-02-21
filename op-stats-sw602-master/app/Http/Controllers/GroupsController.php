<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\GroupUser;

use App\User;

use Auth;
use DB;

class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
        $this->middleware('auth')->only(['create']);
        $this->middleware('auth')->only(['store']);
        $this->middleware('auth')->only(['destroy']);
        $this->middleware('auth')->only(['edit']);
        $this->middleware('auth')->only(['udpate']);
    }

    public function index()
    {

        $groups = Group::orderBy('created_at','desc')->paginate(8);
        return view('groups.index',[
            'groups' => $groups,
        ]);
    }
    public function create()
    {
        return view('groups.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|unique:groups,title|min:2|max:191',
            'body'  => 'required|string|min:5|max:1000',
            ];
            //custom validation error messages
            $messages = [
            'title.unique' => 'Groups title should be unique', //syntax: field_name.rule
            ];
            //First Validate the form data
            $request->validate($rules,$messages);

            $group        = new Group;
            $group->title = strip_tags(request('title'));
            $group->body = strip_tags(request('body'));
            $group->save(); // save it to the database.
            //Redirect to a specified route with flash message.
            return redirect()
            ->route('groups.index')
            ->with('success', true)->with('message',"$group->title created!");
    }
    public function show($id)
    {
        $users = DB::table('users')->get();
        $group_users = DB::table('group_users')->where('group_id','=',$id)->get();
        $group = Group::findOrFail($id);
        return view('groups.show',['group' => $group,'users' => $users,'group_users' => $group_users]);
    }
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('groups.edit',[
        'group' => $group,
        ]);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => "required|string|unique:groups,title,{$id}|min:2|max:191", //Using double quotes
            'body'  => 'required|string|min:5|max:1000',
            ];
            //custom validation error messages
            $messages = [
            'title.unique' => 'Group title should be unique',
            ];
            //First Validate the form data
            $request->validate($rules,$messages);
            $group        = Group::findOrFail($id);
            $group->title = strip_tags(request('title'));
            $group->body = strip_tags(request('body'));
            $group->save(); //Can be used for both creating and updating
            //Redirect to a specified route with flash message.
            return redirect()
            ->route('groups.show',$id)
            ->with('success', true)->with('message',"$group->title updated!");
    }
    public function destroy($id)
    {
       $group = Group::findOrFail($id);
       $group->delete();
       return redirect()
       ->route('groups.index')
       ->with('delsuccess', true)->with('message',"$group->title deleted!");
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $groups = DB::table('groups')->where('title', 'like', '%' . $search . '%')->paginate(5);
        return view('groups.search', ['groups' => $groups], ['search' => $search]);
    }

    public function leaveGroup($group_id){
        $groupname = DB::table('groups')->find($group_id);
        $name = $groupname->title;
        $group_users_id = DB::table('group_users')
                            ->where('group_id','=',$group_id)
                            ->where('user_id','=',Auth::id());
        $group_users_id ->delete();
        return redirect()
       ->route('groups.index')->with('status','You have left the Group '.$name.'.');
    }
    public function joinGroup(Request $request){
        $groupname = DB::table('groups')->find($request->group_id);
        $name = $groupname->title;
        $group_users        = new GroupUser;
            $group_users ->user_id = Auth::id();
            $group_users->group_id  = $request->group_id;
            $group_users->save(); // save it to the database.
            //Redirect to a specified route with flash message.
            return redirect()
            ->route('groups.index')
            ->with('status','You have join the Group '.$name.'.');

    }
}
