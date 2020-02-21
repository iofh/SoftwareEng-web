<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Auth;
use App\Score;
use App\Ban;
use App\User;
use DB;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['auth' => 'verified']);
        $this->middleware('auth')->only(['requestBan']);
        $this->middleware('auth')->only(['unBan']);
        
    }

    public function showUsers()
    {
        $users = DB::table('users')
        ->orderBy('name', 'asc')
        ->get();
        
        
        return view('auth.showUsers',['users'=> $users ]);
    }


    public function requestBan($id)
    {      
        $users = DB::table('users')->get();
        $requestUser = Auth::id();
        $userToBan = DB::table('users')->find($id);
        if(DB::table('bans')
                ->where('request_user_id','=',$requestUser)
                ->where('ban_user_id','=',$id)->doesntExist()){
            $ban = new Ban;
            $ban->request_user_id = $requestUser;
            $ban->ban_user_id = $id;
            $ban->save();           
            if(DB::table('bans')->where('ban_user_id','=',$id)->count()>=2){
                DB::table('users')->where('id','=',$id)->update(['status'=>0]);                            
                $userToBanName = $userToBan->name;
                return view('auth.showUsers',['users'=> $users ])->with('successMsg','User '.$userToBan->name.' has been banned because another user has also voted to ban this user.');
            }else{
                return view('auth.showUsers',['users'=> $users ])->with('successMsg','You voted once on banning '.$userToBan->name.'.');
            }
            
        }else{
            return view('auth.showUsers',['users'=> $users ])->with('successMsg','You have already voted to ban this user '.$userToBan->name.'.');
        }
    }

    public function unBan($id)
    {
        $users = DB::table('users')->get();
        $requestUser = Auth::id();
        $userToBan = DB::table('users')->find($id);
        if(DB::table('bans')
                ->where('request_user_id','=',$requestUser)
                ->where('ban_user_id','=',$id)->exists()){
                    DB::table('bans')
                    ->where('request_user_id','=',$requestUser)
                    ->where('ban_user_id','=',$id)->delete();
            if(DB::table('bans')->where('ban_user_id','=',$id)->count()<=1){
                DB::table('users')->where('id','=',$id)->update(['status'=>1]);          
                if(DB::table('bans')->where('ban_user_id','=',$id)->count()==0){
                    return view('auth.showUsers',['users'=> $users ])->with('successMsg','You have retract your vote to ban '.$userToBan->name.'.');
                }else{
                    return view('auth.showUsers',['users'=> $users ])->with('successMsg','You have retract your vote to ban. User '.$userToBan->name.'\'s ban has been lifted');
                }                
            }else{
                return view('auth.showUsers',['users'=> $users ])->with('successMsg','You have retract your vote to ban '.$userToBan->name.'.');
            }
            
        }else{
            return view('auth.showUsers',['users'=> $users ])->with('successMsg','You have not requested a ban on that user '.$userToBan->name.'.');
        }
    }
    
    public function showIndividual($id){
        $user = DB::table('users')->find($id);
        return view('auth.individual',['user'=> $user,]);
    }

    public function editProfile($id){
        $user = User::findOrFail($id);
        if($user->id == Auth::id()){
            return view('auth.editUser',[
                        'user' => $user,
            ]);
        }else{
            return abort(404);
        }
        
    }
    public function update(Request $request, $id)
    {
        //validation rules
        $rules = [
            'name' => "required|string|min:2|max:191", //Using double quotes
            'image' => 'sometimes|file|image|max:5000',
        ];
        //custom validation error messages
        $messages = [
            'name' => 'Must be more than 2 letter',
            'body' => 'Description must be more than 5 character',
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Update the User
        $user = User::findOrFail($id);
        $user->name = strip_tags(request('name'));
        $this->storeImage($user);
        $user->save(); //Can be used for both creating and updating
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('auth.individual',['user'=> $user,]);
    }

    private function storeImage($user)
    {
        if (request()->has('image')) {
            $user->update([
                $user->image = request()->image->store('uploads', 'public'),
            ]);
            
        }
    }
}
