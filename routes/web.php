<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publico;
use App\Http\Controllers\Estudiante;
use App\Http\Controllers\Docente;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

// ─── Rutas públicas ───────────────────────────────────────────────────────────
Route::get('/', Publico\PortadaController::class)
    ->name('publico.portada');

Route::prefix('modulos')->name('publico.modulos.')->group(function () {
    Route::get('/',         [Publico\ModuloController::class, 'index'])->name('index');
    Route::get('/{modulo}', [Publico\ModuloController::class, 'show'])->name('show');
});

Route::get('/ecosistemas/{ecosistema}', Publico\EcosistemaController::class)
    ->name('publico.ecosistemas.show');

// ─── Rutas del estudiante ─────────────────────────────────────────────────────
Route::middleware(['auth', 'role:estudiante'])
    ->prefix('estudiante')
    ->name('estudiante.')
    ->group(function () {
        Route::get('/dashboard',          Estudiante\DashboardController::class)->name('dashboard');
        Route::get('/perfil/{perfil}',    Estudiante\PerfilController::class)->name('perfil.show');
    });

// ─── Rutas del docente ────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {
        Route::get('/dashboard',                Docente\DashboardController::class)->name('dashboard');
        Route::get('/ecosistemas/{ecosistema}', Docente\EcosistemaController::class)->name('ecosistemas.show');
        Route::get('/progreso/{ecosistema}',    Docente\ProgresoController::class)->name('progreso.show');
    });

// Rutas de autenticación (generadas por Breeze)

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
})->name('logout');

// 1. Ruta para VER el formulario de login
Route::get('/login', function () {
    return view('publico.login'); // Asegúrate de tener este archivo
})->name('login')->middleware('guest');

// 2. Ruta para PROCESAR el login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirige al inicio (o donde tú quieras)
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden con nuestros registros.',
    ]);
});
//require __DIR__.'/auth.php';
