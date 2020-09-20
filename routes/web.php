<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Sign_upController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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
    return view('welcome');
});
Route::post('/main', [UserController::class, 'main']); // 로그인 후 첫 진입화면
Route::get('/test', function () {
  $data[] = ['test1'=>'1','test2'=>'2'];
  $test = array('test1'=>'55','test2'=>'23');
  // $test[] = [1,2];
  return $test;
    return urldecode(json_encode($test));
});
Route::post('/login', [LoginController::class, 'Login']); //로그인
Route::post('/idcheck', [Sign_upController::class, 'idcheck']); //로그인
Route::post('/signup', [Sign_upController::class, 'signup']);  //회원가입

Route::post('/add_post', [PostController::class, 'add_post']);        // 게시글 추가
Route::get('/up_post', [PostController::class, 'up_post']);       // 게시글 수정을 위한 데이터 바인딩
Route::post('/update_post', [PostController::class, 'update_post']);    // 게시글 수정
Route::post('/delete_post', [PostController::class, 'delete_post']);    // 게시글 비활성화(삭제)
Route::post('/SendMessage', [SMSController::class, 'SendMessage']); //SMS 인증
