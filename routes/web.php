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

//Route::get('/', function () { return view('welcome'); }); // TODO: Remover

/* Rotas públicas do SITE */
Route::get('/', function () { return view('site.index'); })->name('site.index');
Route::get('/contato', function () { return view('site.contato'); })->name('site.contato');
Route::get('/sobre', function () { return view('site.sobre'); })->name('site.sobre');
Route::get('/servicos', function () { return view('site.servicos'); })->name('site.servicos');
Route::get('/blog', function () { return view('site.blog'); })->name('site.blog');

Auth::routes(['verify' => true]);

// TODO: Refazer rota home para admin e clientes, ambos possuem acesso ao index e não passa por verificação
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

/* Rotas privadas da APP */
Route::prefix('/app')->middleware('auth')->group(function() {
    Route::resource('projeto', 'ProjetoController')->middleware('check.is.admin');

    Route::resource('arquivo', 'ArquivoController')->middleware('check.is.admin');
    Route::get('/arquivo/download/{id}', [App\Http\Controllers\ArquivoController::class, 'download'])->name('arquivo.download');

    Route::resource('geometria', 'GeometriaController')->middleware('check.is.admin');
    Route::get('/geometria/download/{id}', [App\Http\Controllers\GeometriaController::class, 'download'])->name('geometria.download');
    Route::get('/geometria/getArquivosPorProjeto/{id}', [App\Http\Controllers\GeometriaController::class, 'getArquivosPorProjeto'])->name('getArquivosPorProjeto');
});


/* Rotas privadas da ÁREA DO CLIENTE */
Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/meus-mapas', [App\Http\Controllers\MapaController::class, 'index'])->name('index.mapa');
    Route::get('/mapa/{id}', [App\Http\Controllers\MapaController::class, 'show'])->name('show.mapa');
});



/* Rota para teste do SENTRY */
Route::get('/debug-sentry', function () {
    throw new Exception('Test Sentry error!');
});
