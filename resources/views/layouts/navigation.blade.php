<nav x-data="{ userMenuOpen: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Botón para usuario conectado -->
            <div class="relative">
                <button 
                    @click="userMenuOpen = !userMenuOpen" 
                    class="flex items-center space-x-2 px-4 py-2 text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-white focus:outline-none"
                >
                    <img 
                        src="https://ui-avatars.com/api/?name=John+Doe&background=random" 
                        alt="User Avatar" 
                        class="w-8 h-8 rounded-full"
                    >
                    <span class="hidden sm:block">John Doe</span>
                </button>

                <!-- Menú desplegable -->
                <div 
                    x-show="userMenuOpen" 
                    @click.away="userMenuOpen = false" 
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-md shadow-lg z-50"
                >
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Perfil
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Configuración
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
