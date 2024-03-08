<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //traemos las notificaciones que el ususario no ha leido    
        $notificaciones = auth()->user()->unreadNotifications;

        //limpiar notificaciones
        //markAsRead() marca las notificaciones no leidas como leidas como en fb
        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.index', [
            'notificaciones' => $notificaciones,
        ]);
    }
}
