<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    public function test()
    {
        // Instancia de Firebase usando las credenciales del archivo JSON
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials_file'))
            ->withDatabaseUri(config('firebase.database_url'))
            ->createDatabase();

        // Datos de prueba a guardar en Firebase
        $data = [
            'nombre' => 'John Doe',
            'email' => 'johndoe@example.com',
            'mensaje' => 'Este es un mensaje de prueba'
        ];

        // Referencia a la base de datos donde se guardará el dato
        $database = $firebase->getReference('mensajes')->push($data);

        return redirect()->back()->with('status', 'Datos enviados a Firebase!');
    }
}
