<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\ProductoService;

class ProductoController extends Controller
{
    private ProductoService $productoService;

    public function __construct()
    {
        // la instancia del servicio se crea manualmente, pero
        // se puede obtener mediante el inyector de dependencias
        // se le pasa por parámetro una clase que implementa la interfaz ProductoRepository
        // Aquí es donde se hace la inyección de dependencias
        $this->productoService = new ProductoService(
            new \App\Infraestructura\ProductoRepositoryImpl()
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // obtiene el valor del filtro enviado por la vista, si no hay filtro = ''
        $filtro = $request->input('filtro') ?: '';

        // Define una lista de productos estáticos en lugar de obtenerlos de la base de datos
        $productos = collect([
            (object) ['id' => 1, 'codigo' => 'P001', 'nombre' => 'Producto 1', 'precio' => 10.0],
            (object) ['id' => 2, 'codigo' => 'P002', 'nombre' => 'Producto 2', 'precio' => 15.0],
            (object) ['id' => 3, 'codigo' => 'P003', 'nombre' => 'Producto 3', 'precio' => 20.0],
            (object) ['id' => 4, 'codigo' => 'P004', 'nombre' => 'Producto 4', 'precio' => 25.0],
            (object) ['id' => 5, 'codigo' => 'P005', 'nombre' => 'Producto 5', 'precio' => 30.0],
            (object) ['id' => 6, 'codigo' => 'P006', 'nombre' => 'Producto 6', 'precio' => 35.0],
            (object) ['id' => 7, 'codigo' => 'P007', 'nombre' => 'Producto 7', 'precio' => 40.0],
            (object) ['id' => 8, 'codigo' => 'P008', 'nombre' => 'Producto 8', 'precio' => 45.0],
            (object) ['id' => 9, 'codigo' => 'P009', 'nombre' => 'Producto 9', 'precio' => 50.0],
            (object) ['id' => 10, 'codigo' => 'P010', 'nombre' => 'Producto 10', 'precio' => 55.0],
        ]);

        // Pasa los productos estáticos a la vista
        return view('producto.lista-productos', [
            'productos' => $productos,
            'filtro' => $filtro,  // pasa el valor del filtro a la vista para que lo muestre
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('producto.nuevo-producto');
    }

    public function pago()
    {
        return view('producto.pago-producto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => ['required', 'max:20'],
            'nombre' => ['required'],
            'precio' => ['required', 'numeric'],
        ]);

        $this->productoService->nuevoProducto($validatedData);

        return redirect('producto/index');
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
        // recupera el producto
        $producto = $this->productoService->getProducto($id);

        // si el producto no existe, vuelve atrás mostrando un error
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
        $validatedData = $request->validate([
            'codigo' => ['required', 'max:20'],
            'nombre' => ['required'],
            'precio' => ['required', 'numeric'],
        ]);

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
}
