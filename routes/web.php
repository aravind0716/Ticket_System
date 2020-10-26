<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customercontroller;
use App\Http\Controllers\employeecontroller;
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

Route::get('/', function () {
    return view('Login');
});


Route::get('/login', function () {
    return view('Login');
});

Route::get('signup',function(){
    return view('signup');
});

Route::get('/employeelogin', function () {
    return view('employeelogin');
});

Route::get('/customerlogin', function () {
    return view('customerlogin');
});

Route::get('customer',function(){
     return view('customer');
});

Route::get('employee',function(){
    return view('employee');
});

Route::get('tickets',function(){
    return view('employeetickets');
});

Route::get('newticket',function(){
    return view('newticket');
});

Route::get('ticketinfo',function(){
    return view('ticketinfo');
});
Route::get('created',function (){
    return view('created');
});

Route::post('customer',[customercontroller::class,'authenticate']);

Route::post('employee','App\Http\Controllers\employeecontroller@authenticate');

Route::get('insert','App\Http\Controllers\customercontroller@insertform');

Route::post('create','App\Http\Controllers\customercontroller@insert');

Route::get('insert','App\Http\Controllers\employeecontroller@insertform');

Route::post('create1','App\Http\Controllers\employeecontroller@insert');

Route::post('newt',[customercontroller::class,'ticketnew']);

Route::post('showt',[customercontroller::class,'showtickets']);

Route::post('empshow',[employeecontroller::class,'showtickets']);

Route::post('deleteticket',[customercontroller::class,'deleteticket']);

Route::post('changestatus',[employeecontroller::class,'updateticket']);

Route::post('custlogout',[customercontroller::class,'customerlogout']);

Route::post('emplogout',[employeecontroller::class,'logout']);

Route::post('completed',[customercontroller::class,'completed']);
