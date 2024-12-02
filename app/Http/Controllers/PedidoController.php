<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Application\PedidoService;
use App\Infraestructura\PedidoRepositoryFb;

class PedidoController extends Controller
{
    private PedidoService $pedidoService;

    public function __construct()
    {
        // Se pasa la implementación de PedidoRepositoryFb al servicio
        $this->pedidoService = new PedidoService(
            new PedidoRepositoryFb()
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filtro = $request->input('filtro') ?: '';
        $pedidos = $this->pedidoService->searchPedido($filtro);

        return view('pedido.lista-pedidos', [
            'pedidos' => $pedidos,
            'filtro' => $filtro,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo("llego al create controler");
        return view('pedido.nuevo-pedido');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos del pedido
       // echo("LLegao a store controller");
        $validatedData = $request->validate([
            'estado' => ['required'],
            'total' => ['required', 'numeric'],
            'tipoPago' => ['required'],
            'nroTransaccion' => ['required'],
            'productos' => ['required']
        ]);
        //echo("aaaa");
        $this->pedidoService->nuevoPedido($validatedData);

        // Enviar respuesta JSON
        return response()->json([
            'message' => 'Pedido creado exitosamente',
            'data' => $validatedData
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pedido = $this->pedidoService->getPedido($id);

        if (!$pedido) {
            return redirect()->back()->withErrors('El pedido no existe');
        }

        return view('pedido.detalle-pedido', [
            'pedido' => $pedido,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $pedido = $this->pedidoService->getPedido($id);

        if (!$pedido) {
            return redirect()->back()->withErrors('El pedido no existe');
        }

        return view('pedido.modificar-pedido', [
            'pedido' => $pedido,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validación de los campos del pedido
        $validatedData = $request->validate([
            'estado' => ['required'],
            'total' => ['required', 'numeric'],
            'tipoPago' => ['required'],
            'nroTransaccion' => ['required'],
            'productos' => ['required'], // Array de productos
        ]);

        $this->pedidoService->modificarPedido($id, $validatedData);

        return redirect('/pedidos')->with('success', 'Pedido actualizado exitosamente');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->pedidoService->eliminarPedido($id);

        return redirect('/pedidos')->with('success', 'Pedido eliminado exitosamente');
    }

    /**
     * Devuelve un ejemplo de datos estáticos para fines ilustrativos.
     */
    public function getSemana()
    {
        $semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return response()->json($semana);
    }
}
