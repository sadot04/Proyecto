<?php

namespace App\Http\Controllers;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseTestController extends Controller
{
    public function testConnection()
    {
        try {
            $firestore = new FirestoreClient([
                'projectId' => env('FIREBASE_PROJECT_ID'),
                'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS')), 
                'transport' => 'rest',
            ]);

            $data = ['test_field' => 'Conexión exitosa'];
            $firestore->collection('test_collection')->add($data);

            return response()->json(['message' => 'Conexión exitosa y datos guardados en Firestore']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error de conexión: ' . $e->getMessage()], 500);
        }
    }
}