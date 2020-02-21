<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Auth;
use App\Score;
use DB;

class ScoresController extends Controller
{

    public function __construct(){
        $this->middleware(['auth' => 'verified']);
        $this->middleware('auth')->only(['create']);
        $this->middleware('auth')->only(['store']);
        $this->middleware('auth')->only(['destroy']);
        $this->middleware('auth')->only(['edit']);
        $this->middleware('auth')->only(['udpate']);

    }

    public function create()
    {
        $users = DB::table('users')->get();
        
        $games = DB::table('games')->get();

        return view('scores.create',['users'=> $users ,'games'=>$games]);
    }

     //Alister's show function to store games
    public function store(Request $request)
    {
        //validation rules
    $rules = [
        'score' => 'required|integer|',
        
    ];
        //custom validation error messages
        $messages = [
            'score.required' => 'Score can\'t be left empty', //syntax: field_name.rule
            'score.integer' => 'Score must be only numbers', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Create a Game
        $scores       = new Score;
        $scores->score = $request->score;
        $scores->game_id  = $request->game_id;
        $scores->user_id = Auth::id();
        $scores->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('games.index')
            ->with('scoresuccess', true)->with('message'," Score added!");
        }


     //show all games, when games are installed, the games can be seen under ViewGames
    public function index()
    {
        $users = DB::table('users')->get();
        $scores = DB::table('scores')->where('game_id','like','%'.$id.'%');
        $games = DB::table('games')->where('id','like','%'.$id.'%'); 
        $games = $games->get();
        $scores = $scores->get();
        
        return view('games.showScore',['scores' => $scores, 'users'=> $users ,'games'=>$games]);
     }
     
    
     public function show($id)
    {
        $scores = Score::findOrFail($id);
        $games = Game::findOrFail($scores->game_id);
        $user_id = Auth::id();
        //$games = DB::table('games')->get();    
        return view('scores.show',[
            'scores' => $scores,'games'=>$games,'user_id'=>$user_id,
        ]);
    }
    

    //Frederic's destory function
    public function destroy($id)
    {
    //Delete the Game
    $score = Score::findOrFail($id);
    $score->delete();
    //Redirect to a specified route with flash message.
    return redirect()
        ->route('games.show',$score->game_id)
        ->with('scoredelsuccess', true)->with('message'," Score deleted!");
    }


    //Frederic's edit function
    public function edit($id)
    {
    //Find a Game by it's ID
    $score = Score::findOrFail($id);
    $games = DB::table('games')->get();     
    return view('scores.edit',[
        'score' => $score,'games'=>$games,
    ]);
    }


    //Frederic's update function
    public function update(Request $request, $id)
   {
    //validation rules
    $rules = [
        'score' => 'required|integer|',
        
    ];
        //custom validation error messages
        $messages = [
            'score.required' => 'Score can\'t be left empty', //syntax: field_name.rule
            'score.integer' => 'Score must be only numbers', //syntax: field_name.rule
        ];
    //First Validate the form data
    $request->validate($rules,$messages);
    //Update the Game
    $score        = Score::findOrFail($id);
    $score->score = $request->score;
    $score->game_id  = $score->game_id;
    //$scores->user_id =Auth::id();
    $score->save(); //Can be used for both creating and updating
    //Redirect to a specified route with flash message.
    return redirect()
        ->route('games.index')
        ->with('status','Updated the selected Game!');
    }


}
