<?php

namespace App\Infraestructura;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseConnection
{
    private static function getDatabase(): Database
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('storage/app/firebase_credentials.json')) // Archivo de credenciales descargado desde Firebase
            ->withDatabaseUri('https://tbproyectos-f05e7-default-rtdb.firebaseio.com');
        
        return $factory->createDatabase();
    }

    
    public static function set(string $path, array $data): void
    {
        $database = self::getDatabase();
        $database->getReference($path)->set($data);
    }

    /**
     * Obtiene los datos de un nodo de la base de datos de Firebase.
     * @param string $path Ruta del nodo.
     * @return array|null Datos obtenidos o null si no existen.
     */
    public static function get(string $path): ?array
    {
        $database = self::getDatabase();
        $snapshot = $database->getReference($path)->getSnapshot();
        
        return $snapshot->exists() ? $snapshot->getValue() : null;
    }
}
