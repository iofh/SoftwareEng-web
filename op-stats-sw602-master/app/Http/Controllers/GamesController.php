<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Game;
use Auth;
use App\Score;
use DB;
use App\Genre;

class GamesController extends Controller
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
        //
        $genres = Genre::all();
        return view('games.create', compact('genres'));
    }

    //Alister's show function to store games
    public function store(Request $request)
    {
        //validation rules

    $rules = [
        'title' => 'required|string|unique:games,title|min:2|max:191',
        'body'  => 'required|string|min:5|max:1000',
        'image' => 'sometimes|file|image|max:5000',
        'genre' => 'required',
    ];

        //custom validation error messages
        $messages = [
            'title.unique' => 'Game title should be unique', //syntax: field_name.rule
            'body' => 'Description must be more than 5 character',
            'genre' => 'Please select a genre for the game',
        ];
        //First Validate the form data
        $request->validate($rules, $messages);

        //Create a Game
        $game = new Game;
        $game->title = strip_tags(request('title'));
        $game->body = strip_tags(request('body'));
        $this->storeImage($game);
        $game->genre_id = $request->genre+1;
        $game->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('games.index')
            ->with('success', true)->with('message',"$game->title created!");
    }


     //show all games, when games are installed, the games can be seen under ViewGames
    public function index()
    {
        $genres = Genre::all();
        $games = Game::orderBy('created_at','desc')->paginate(8);
        return view('games.index',['games' => $games,'genres'] );
     }
     
    
     public function show($id)

    {

        $users = DB::table('users')->get();
        $scores = DB::table('scores')->where('game_id', 'like', '%' . $id . '%');
        $scores = $scores->get();
        $game = Game::findOrFail($id);
        $genres = Genre::all();


        return view('games.show',['scores' => $scores, 'users'=> $users ,'game'=>$game, 'genres']);


    }



    public function destroy($id)
    {
        //Delete the Game
        $game = Game::findOrFail($id);
        $game->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('games.index')
            ->with('delsuccess', true)->with('message',"$game->title deleted!");
    }

    //Frederic's edit function
    public function edit($id)
    {
        //Find a Game by it's ID
        $game = Game::findOrFail($id);


        return view('games.edit',[

            'game' => $game,
        ]);
    }

    
    public function update(Request $request, $id)

   {
    //validation rules
    $rules = [
        'title' => "required|string|unique:games,title,{$id}|min:2|max:191", //Using double quotes
        'body'  => 'required|string|min:5|max:1000',
        'image' => 'sometimes|file|image|max:5000',
    ];
    //custom validation error messages
    $messages = [
        'title.unique' => 'Game title should be unique',
        'body' => 'Description must be more than 5 character',
    ];
    //First Validate the form data
    $request->validate($rules,$messages);
    //Update the Game
    $game        = Game::findOrFail($id);
    $game->title = strip_tags(request('title'));
    $game->body = strip_tags(request('body'));
    $this->storeImage($game);
    $game->save(); //Can be used for both creating and updating
    //Redirect to a specified route with flash message.
    return redirect()
        ->route('games.show',$id)
        ->with('success', true)->with('message',"$game->title updated!");
    }
    
    public function search(Request $request){

        $genres = Genre::all();
        $search = $request->get('search');
        $games = DB::table('games')->where('title', 'like', '%' . $search . '%')->paginate(5);
        return view('games.search', ['games' => $games], ['search' => $search]);
    }

    public function showScore($id)
    {
        $genres = Genre::all();
        $users = DB::table('users')->get();
        $scores = DB::table('scores')->where('game_id', '=',  $id );
        $games = DB::table('games')->where('id', '=', $id );
        $games = $games->get();
        $scores = $scores->get();



        return view('games.showScore', ['scores' => $scores, 'users' => $users, 'games' => $games]);

    }

    private function validateRequest(){
        return request()->validate([
            'title' => "required|string|unique:games,title,{$id}|min:2|max:191", //Using double quotes
            'body'  => 'required|string|min:5|max:1000',
            'image' => 'sometimes|file|image|max:5000',
        ]);
    }

    private function storeImage($game)
    {
        if (request()->has('image')) {
            $game->update([

                $game->image = request()->image->store('uploads', 'public'),

            ]);
            
        }
    }

}

