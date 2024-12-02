<?php

namespace App\Core\Application;

use Exception;
use App\Core\Dominio\Pedido;
use App\Core\Dominio\PedidoRepository;

class PedidoService
{
    public function __construct(
        private PedidoRepository $pedidoRepository
    ) {}

    /**
     * Crea un nuevo pedido.
     *
     * @param array $data Datos del pedido.
     * @return Pedido
     * @throws Exception
     */
    public function nuevoPedido(array $data): Pedido
    {
        $pedidoId = $this->pedidoRepository->nextIdentity();
       // echo("aaaa");
        $pedido = new Pedido(
            $pedidoId,
            $data['estado'],
            floatval($data['total']),
            $data['tipoPago'],
            $data['nroTransaccion'],
            $data['productos']
        );

        $this->pedidoRepository->store($pedido);

        return $pedido;
    }

    /**
     * Modifica un pedido existente.
     *
     * @param int $id ID del pedido.
     * @param array $data Nuevos datos para el pedido.
     * @throws Exception
     */
    public function modificarPedido(int $id, array $data): void
    {
        $pedido = $this->getPedido($id);

        if ($pedido === false) {
            throw new Exception("Pedido no encontrado");
        }

        $pedido->setEstado($data['estado']);
        $pedido->setTotal(floatval($data['total']));
        $pedido->setTipoPago($data['tipoPago']);
        $pedido->setNroTransaccion($data['nroTransaccion']);
        $pedido->setProductos($data['productos']);

        $this->pedidoRepository->store($pedido);
    }

    /**
     * Elimina un pedido por su ID.
     *
     * @param int $id ID del pedido.
     * @throws Exception
     */
    public function eliminarPedido(int $id): void
    {
        $pedido = $this->getPedido($id);

        if ($pedido === false) {
            throw new Exception("Pedido no encontrado");
        }

        $this->pedidoRepository->remove($pedido->getId());
    }

    /**
     * Obtiene un pedido por su ID.
     *
     * @param int $id ID del pedido.
     * @return Pedido|false
     */
    public function getPedido(int $id): Pedido|false
    {
        return $this->pedidoRepository->getById($id);
    }

    /**
     * Busca pedidos según un filtro.
     *
     * @param string $filtro Filtro de búsqueda.
     * @return array
     */
    public function searchPedido(string $filtro): array
    {
        return $this->pedidoRepository->search($filtro);
    }
}
