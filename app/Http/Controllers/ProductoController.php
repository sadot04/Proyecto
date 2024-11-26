<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Core\Application\ProductoService;
use App\Infraestructura\ProductoRepositoryFb;

class ProductoController extends Controller
{
    private ProductoService $productoService;

    public function __construct()
    {
        // Se pasa la implementación de ProductoRepositoryFb al servicio
        $this->productoService = new ProductoService(
            new ProductoRepositoryFb()
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filtro = $request->input('filtro') ?: '';
        $productos = $this->productoService->searchProducto($filtro);

        return view('producto.lista-productos', [
            'productos' => $productos,
            'filtro' => $filtro,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.nuevo-producto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        // Validación de los nuevos campos
        $validatedData = $request->validate([
            'nombre' => ['required'],
            'marca' => ['required'],
            'precio' => ['required', 'numeric'],
            'talla' => ['required', 'numeric'],
            'color' => ['required'],
            'stock' => ['required', 'numeric'],
        ]);

        $this->productoService->nuevoProducto($validatedData);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "mostrando: id=" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        // Recupera el producto por ID
        $producto = $this->productoService->getProducto($id);

        // Verifica si el producto existe
        if (!$producto) {
            return redirect()->back()->withErrors('El producto no existe');
        }

        return view('producto.modificar-producto', [
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los nuevos campos
        $validatedData = $request->validate([
            'nombre' => ['required'],
            //'marca' => ['required'],
            'precio' => ['required', 'numeric'],
            //'talla' => ['required', 'numeric'],
            //'color' => ['required'],
            //'stock' => ['required', 'numeric'],
        ]);

        // Llama al servicio para actualizar el producto
        $this->productoService->modificarProducto($id, $validatedData);

        return redirect('producto/index')->with('success', 'Producto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productoService->eliminarProducto($id);

        return redirect('producto/index')->with('success', 'Producto eliminado');
    }

    public function getSemana()
    {
        $semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return response()->json($semana);
    }
}
