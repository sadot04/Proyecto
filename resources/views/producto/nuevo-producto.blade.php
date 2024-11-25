<x-layout>
    <div class="p-6 dark:bg-gray-900">
        <h1 class="text-white text-2xl font-bold mb-4">Nuevo Producto</h1>

        <form action="{{ url('producto/create') }}" method="post">
            @csrf

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
                <label for="talla" class="block text-white font-medium mb-1">Talla</label>
                <input type="number" name="talla" id="talla" class="form-control @error('talla') is-invalid @enderror" value="{{ old('talla') }}" />
                @error('talla')
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
                <label for="stock" class="block text-white font-medium mb-1">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" />
                @error('stock')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>
</x-layout>
