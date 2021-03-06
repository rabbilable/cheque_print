<?php

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
    return view('index');
});

Route::resource('bank', 'BankController');
Route::get('bank/daterange/filter', 'BankController@filter')->name('bank.filter');

Route::resource('cheque', 'ChequeController');
Route::get('cheque/daterange/filter', 'ChequeController@filter')->name('cheque.filter');


Route::get('print/{cheque}', 'ChequeController@print')->name('print.cheque');
Route::get('print/ib/{cheque}', 'ChequeController@printIb')->name('print.cheque.ib');



Auth::routes();

