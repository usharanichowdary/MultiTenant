<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        $users = User::get();
        
        // dd(\DB::table('users')->get()->toArray());
        dd($users->toArray());

        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

   
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('tenant.login.store');

    
    Route::get('/register', [AuthController::class, 'register'])->name('tenant.register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('tenant.register.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('tenant.logout');

    Route::get('/dashboard',function(){
        //dd(auth()->user()->toArray());
        //dd('dashboard page');
        return view('tenant.dashboard');
    })->name('tenant.dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });
    
});


