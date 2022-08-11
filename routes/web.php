<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/1', static function () {
    return view('/email.audit.user.new-request-notification');
});

Route::get('/2', static function () {
    return view('/email.audit.consultant.new-request-notification');
});

Route::get('/3', static function () {
    return view('/email.definitive-departure.consultant.new-departure-comunication-request-notification');
});

Route::get('/4', static function () {
    return view('/email.definitive-departure.user.new-departure-comunication-request-notification');
});

Route::get('/5', static function () {
    return view('/email.definitive-departure.user.new-request-notification');
});

Route::get('/6', static function () {
    return view('/email.legacy.access-code');
});

Route::get('/7', static function () {
    return view('/email.notification.legacy-status.new');
});

Route::get('/8', static function () {
    return view('/email.notification.legacy-status.ongoing');
});

Route::get('/9', static function () {
    return view('/email.notification.legacy-status.return');
});

Route::get('/10', static function () {
    return view('/email.notification.legacy-status.transmitted');
});

Route::get('/11', static function () {
    return view('/email.password-create');
});

Route::get('/12', static function () {
    return view('/email.password-recover');
});

Route::get('/13', static function () {
    return view('/email.payment.accepted');
});

Route::get('/14', static function () {
    return view('/email.payment.notification');
});

Route::get('/15', static function () {
    return view('/email.payment.refund');
});

Route::get('/16', static function () {
    return view('/email.payment.refund-notification');
});

Route::get('/17', static function () {
    return view('/email.specialist.invite');
});

Route::get('/18', static function () {
    return view('/email.specialist.lead');
});

Route::get('/19', static function () {
    return view('/email.status.user.change-notification');
});

Route::get('/20', static function () {
    return view('/email.contact');
});
