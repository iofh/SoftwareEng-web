<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Auth;
use App\Score;
use DB;
use App\Genre;

class PagesController extends Controller
{
	public function index(){
        $users = DB::table('users')
        ->orderBy('name', 'asc')
        ->take(5)
        ->get();

        $genres = DB::table('genres')->get();

 
        $scores = DB::table('scores')
        ->orderBy('score', 'desc')
        ->take(5)
        ->get();
        


        $games = Game::orderBy('body','asc')
        ->take(5)
        ->get();


        $popgames = DB::table('games')
        ->join('scores', 'games.id', '=', 'scores.game_id')
        ->select('games.title', DB::raw('COUNT(scores.game_id) as score_count'))
        ->orderBy('score_count', 'desc')

        ->groupBy('title')
        ->get(); 
        return view('pages.index',['scores' => $scores, 'users'=> $users ,'games'=>$games, 'popgames'=>$popgames, 'genres']);
    }

    public function about(){
        return view('pages.about');
    }

}
