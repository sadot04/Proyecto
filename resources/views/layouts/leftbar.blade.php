<div x-data="{ open: true }" class="h-full">
    <!-- Left Sidebar -->
    <aside 
        class="bg-gray-700 text-gray-200 h-full transition-all duration-300 flex flex-col items-center" 
        :style="open ? 'width: 10rem;' : 'width: 4rem;'"
    >
        <!-- Botón -->
        <div class="p-2 flex items-center justify-center">
            <button @click="open = !open" class="text-white bg-blue-600 p-2 rounded-full focus:outline-none">
                <span x-show="open">Menú</span>
                <span x-show="!open">≡</span>
            </button>
        </div>
        
        <!-- Menú -->
        <nav class="mt-4 flex-1 w-full">
            <ul class="space-y-2">
                <li>
                    <a href="<?= url('producto/index') ?>" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded truncate">Productos</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded truncate">Proveedores</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 rounded truncate">Ventas</a>
                </li>
            </ul>
        </nav>
    </aside>
</div>
