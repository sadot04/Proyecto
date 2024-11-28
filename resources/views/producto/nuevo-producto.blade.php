<x-layout>
    <div class="p-6 dark:bg-gray-800">
        <h1 class="text-white text-2xl font-bold mb-4">Nuevo Producto</h1>

        <form action="{{ url('producto/create') }}" method="post">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-3">
                    <label for="nombre" class="block text-white font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" />
                    @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="marca" class="block text-white font-medium mb-1">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}" />
                    @error('marca')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="precio" class="block text-white font-medium mb-1">Precio</label>
                    <input type="text" inputmode="numeric" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio') }}" />
                    @error('precio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="block text-white font-medium mb-1">Color</label>
                    <input type="text" name="color" id="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" />
                    @error('color')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="imagenUrl" class="block text-white font-medium mb-1">URL de la Imagen</label>
                    <input type="url" name="imagenUrl" id="imagenUrl" class="form-control @error('imagenUrl') is-invalid @enderror" value="{{ old('imagenUrl') }}" />
                    @error('imagenUrl')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="button" id="toggle-stock" class="bg-white text-gray-800 py-2 px-4 rounded border border-gray-400">Agregar Stock por Tallas</button>
            </div>

            <div id="stock-fields" class="mt-4">
                <h2 class="text-white text-xl font-bold mb-2">Stock por Tallas</h2>
                <div class="grid grid-cols-5 gap-4">
                    @foreach([36, 38, 40, 42, 44] as $talla)
                        <div class="mb-3">
                            <label for="stock{{ $talla }}" class="block font-medium mb-1">Talla {{ $talla }}</label>
                            <input type="number" name="stock{{ $talla }}" id="stock{{ $talla }}" class="form-control @error('stock' . $talla) is-invalid @enderror"
                                   value="{{ old('stock' . $talla, 0) }}" required />
                            @error('stock' . $talla)
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="mt-4">
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
