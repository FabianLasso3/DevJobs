<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| 
Brezee paquete de autentificacion de laravel permite crear cuenta autenticar resetear password confirmar cuenta verificar mail
descargar: composer require laravel/brezee --dev  instalar: php artisan breeze:install  blade yes y 0 por ultimo npm install
Esto va a generar toda la parte del login, formularios, tambien un dashboard y migraciones todo usa tailwind css  
lo generado esta en resources/view por si quieres cambiar algo
Crea una nuevas rutas en routes el archivo es auth 

otros paquetes: Fortify: para el frontend Sanctum: diseñado para aplicaciones SPA jetStream: ideal para el inicio de aplicacion de laravel
  
https://github.com/MarcoGomesr/laravel-validation-en-espanol descargar para traduccir lo hecho en breeze

implements MustVerifyEmail se agrega esto al modelo de user para que el usuario tenga un usuario verificado

para modificar el correo que llega para la autentificacion eso se hace desde los providers en authserviceprovider

php artisan make:controller VacanteController -r se usa -r para que sea un resource controller

Un seed en una bd es agregar datos que no van a ser dinamicos php artisan db:seed

Crear mas migraciones conforme vas agregando mas campos o columnas

Crear componente con livewire php artisan make:livewire nombre

publicar un paquete php artisan vendor:publish --tag=laravel-pagination lo sacamos de vendor en este caso sirve para modificar el idioma de la paginacion del tailwind

php artisan storage:link para crear un link simbolico = las imagenes se almacenan en storage pero el usuario solo puede acceder a public acceso directo que hace referencia a otro archivo  

php artisan make:policy VacantePolicy --model=Vacante crear policy y modelo

php artisan make:notification nombre permite saber cuando ocurre un evento en la app puede ser en la pagina, correo o sms
php artisan make:notificacitons:table crea una migracion crea una tablea de notificaciones
php artisan make:controller NotificacionController --invokable controlador que solo va a tener un metodo


Crear middleware php artisan make:middleware Nombre, se ejecutan muchos midelware a la ves hay que agregarlo al kernel.php es para crear algo como verified o el auth   
crear multiples midelware si es que tienes muchos ifs
*/

Route::get('/', HomeController::class)->name('home');

//middleware(['auth', 'verified']) hace que el usuario este autnticado y verificado para acceder al dashboard
Route::get('/dashboard', [VacanteController::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index');
Route::get('/vacantes/create', [VacanteController::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');
Route::get('/candidatos/{vacante}', [CandidatoController::class, 'index'])->name('candidatos.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//notificaciones
Route::get('/notificaciones', NotificacionController::class)->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

require __DIR__.'/auth.php';
