<x-layout>
    <x-slot:title>Modificar Producto</x-slot:title>

    <div class="p-6 dark:bg-gray-800 text-white">
        <h1 class="mb-4 text-center text-2xl font-bold">Modificar Producto</h1>

        <form action="{{ url('producto/update', ['id' => $producto->getId()]) }}" method="post">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                    <label for="nombre" class="block font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror text-black"
                           value="{{ old('nombre', $producto->getNombre()) }}" required />
                    @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="marca" class="block font-medium mb-1">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror text-black"
                           value="{{ old('marca', $producto->getMarca()) }}" required />
                    @error('marca')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="block font-medium mb-1">Precio</label>
                    <input type="number" step="0.01" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror text-black"
                           value="{{ old('precio', $producto->getPrecio()) }}" required />
                    @error('precio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="block font-medium mb-1">Color</label>
                    <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror text-black"
                           value="{{ old('color', $producto->getColor()) }}" required />
                    @error('color')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="imagenUrl" class="block font-medium mb-1">URL de la Imagen</label>
                    <input type="url" name="imagenUrl" id="imagenUrl" class="form-control @error('imagenUrl') is-invalid @enderror text-black"
                           value="{{ old('imagenUrl', $producto->getImagenUrl()) }}" required />
                    @error('imagenUrl')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="button" id="toggle-stock" class="bg-white text-gray-800 py-2 px-4 rounded border border-gray-400">Modificar Stock por Tallas</button>
            </div>

            <div id="stock-fields" class="mt-4">
                <h2 class="text-white text-xl font-bold mb-2">Stock por Tallas</h2>
                <div class="grid grid-cols-5 gap-4">
                    @foreach([36, 38, 40, 42, 44] as $talla)
                        <div class="mb-3">
                            <label for="stock{{ $talla }}" class="block font-medium mb-1">Talla {{ $talla }}</label>
                            <input type="number" name="stock{{ $talla }}" id="stock{{ $talla }}" class="form-control @error('stock' . $talla) is-invalid @enderror text-black"
                                   value="{{ old('stock' . $talla, $producto->{'getStock' . $talla}()) }}" required />
                            @error('stock' . $talla)
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('toggle-stock').addEventListener('click', function () {
            const stockFields = document.getElementById('stock-fields');
            stockFields.classList.toggle('hidden');
        });
    </script>
</x-layout>
