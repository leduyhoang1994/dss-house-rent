<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dss.index');
});

Route::get('/dss', function (\Illuminate\Http\Request $request) {

    try {
        $service = new \App\DssService();
        $service->load(
            $request->get('name'),
            $request->get('b1_income'),
            $request->get('b2_transport'),
            $request->get('b3_work'),
            $request->get('b4_mates'),
            $request->get('b5_meal'),
            $request->get('b6_assets')
        );
        $ratedHouses = $service->calculate();
    } catch (Exception $exception) {
        $ratedHouses = collect();
    }
    $studentInfo = [
        'name' => $request->get('name'),
        'b1_income' => $request->get('b1_income'),
        'b2_transport' => $request->get('b2_transport'),
        'b3_work' => $request->get('b3_work'),
        'b4_mates' => $request->get('b4_mates'),
        'b5_meal' => $request->get('b5_meal'),
        'b6_assets' => $request->get('b6_assets')
    ];

    return view('dss.result', compact('ratedHouses', 'studentInfo'));
})->name('dss-result');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
