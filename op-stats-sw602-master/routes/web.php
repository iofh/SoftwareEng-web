<?php
use Illuminate\Support\Facades\Input;
use App\Game;
use App\Http\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('home');
});

//Route::get('/scores/create','ScoresController@create')->name('scores.create');
//Route::post('/scores','ScoresController@store')->name('scores.store'); // making a post request
Route::resource('/scores','ScoresController');
Route::resource('/groups','GroupsController');
Route::get('/groups/{id}/leave','GroupsController@leaveGroup')->name('group_user.leaveGroup');
Route::post('/groups/{id}/join','GroupsController@joinGroup')->name('group_user.joinGroup');
// Route::get('/search','GroupsController@search')->name('groups.search');

Route::get('/search','GamesController@search')->name('games.search');
Route::get('/games/{id}/scores','GamesController@showScore')->name('games.showScores');
Route::resource('/games','GamesController');

Route::post('/groups/{id}/join','GroupsController@joinGroup')->name('group_user.joinGroup');//GroupJoin

Route::get('/','PagesController@index')->name('pages.index');
Route::get('/about','PagesController@about')->name('pages.about');
Route::get('/showUser','UserController@showUsers')->name('auth.showUsers');
Route::get('/individual/{id}/edit','UserController@editProfile')->name('auth.edit');
Route::put('/individual/{id}/update','UserController@update')->name('auth.update');
Route::get('/individual/{id}','UserController@showIndividual')->name('auth.individual');
Route::get('/individual/{id}/ban','UserController@requestBan')->name('auth.requestBan');
Route::get('/individual/{id}/unban','UserController@unBan')->name('auth.unBan');

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Route::get('/send-mail', function () {
 
    Mail::to('newuser@example.com')->send(new MailtrapExample()); 
 
    return 'A message has been sent to Mailtrap!';
 
});





Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');


Route::get('/send-mail', function () {
 
    Mail::to('newuser@example.com')->send(new MailtrapExample()); 
 
    return 'A message has been sent to Mailtrap!';
 
});

Route::resource('/groups','GroupsController');


/*Route::get('/','GamesController@index')->name('pages.index');
Route::get('/about','GamesController@about')->name('pages.about');
Route::get('/games','GamesController@index')->name('games.index');
Route::get('/games/create','GamesController@create')->name('games.create')->middleware('auth');
Route::post('/games','GamesController@store')->name('games.store'); // making a post request
Route::get('/games/{id}','GamesController@show')->name('games.show');
Route::get('/games/{id}/edit','GamesController@edit')->name('games.edit')->middleware('auth');
Route::put('/games/{id}','GamesController@update')->name('games.update')->middleware('auth'); // making a put request
Route::delete('/games/{id}','GamesController@destroy')->name('games.destroy')->middleware('auth'); // making a delete request
*/
Auth::routes();


