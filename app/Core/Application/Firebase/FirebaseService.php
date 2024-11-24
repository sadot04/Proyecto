<?php

namespace App\Core\Application\Firebase;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(config('firebase.credentials_file'))
            ->withDatabaseUri(config('firebase.database_url'));

        $this->database = $firebase->createDatabase();
    }

    public function getDatabase()
    {
        return $this->database;
    }
}