<x-layout>
    <x-slot:title>Lista de productos</x-slot:title>

    <div class="p-6 dark:bg-gray-800">
        <div class="p-6 text-white">
            <h1 class="mb-4 text-center display-5">Lista de productos</h1>
        </div>


        <div class="p-4">
            <table class="table table-striped table-bordered table-hover custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->getId() }}</td>
                            <td>{{ $producto->getNombre() }}</td>
                            <td class="text-end">{{ number_format($producto->getPrecio(), 1) }}</td>
                            <td class="text-center">
                                <!-- Acción editar -->
                                <a href="{{ url('producto/edit', ['id' => $producto->getId()]) }}" class="btn btn-sm btn-outline-primary">
                                    Editar
                                </a>

                                <!-- Acción eliminar -->
                                <form action="{{ url('producto/destroy', ['id' => $producto->getId()]) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Desea eliminar el producto?');">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout>



    <style>
        /* Personalización de la tabla */
        .custom-table {
            color: #fff; /* Texto blanco */
        }
        .custom-table th,
        .custom-table td {
            padding: 12px 15px; /* Espaciado en las celdas */
        }
        .custom-table th {
            background-color: #343a40; /* Fondo oscuro para el encabezado */
            text-align: center;
        }
        .custom-table tr:nth-child(even) {
            background-color: #4a5568; /* Color alterno para filas pares */
        }
        .custom-table tr:nth-child(odd) {
            background-color: #2d3748; /* Color alterno para filas impares */
        }
        .custom-table tr:hover {
            background-color: #1a202c; /* Color al pasar el mouse */
        }
    </style>
