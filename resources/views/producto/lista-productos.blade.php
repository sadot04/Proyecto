<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Zapatillas</title>
    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        x-layout {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100%;
        }
        .talla-button {
            padding: 10px;
            margin: 5px;
            cursor: pointer;
        }

        .talla-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .contenido-principal {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        .catalogo, .detalles-producto, .pantalla-compra {
            flex: 3;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            overflow-y: auto;
            background-color: #f4f4f4;
        }
        .carrito {
            flex: 1;
            background-color: white;
            border-left: 1px solid #ddd;
            padding: 20px;
            overflow-y: auto;
        }
        .producto {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .producto img {
            max-width: 200px;
            height: 200px;
            object-fit: cover;
        }
        .boton {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .boton-secundario {
            background-color: #2196F3;
        }
        header, footer {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .detalles-producto, .pantalla-compra {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .detalles-producto img {
            max-width: 400px;
            height: 400px;
            object-fit: cover;
        }
        .metodos-pago {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .detalles-tallas {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            justify-content: center;
        }
        .talla-button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }
        .talla-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .contenido-principal {
                flex-direction: column;
            }
            .carrito {
                border-left: none;
                border-top: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>
<x-layout>
    <header>
        <h1>Tienda de Zapatillas</h1>
    </header>
    
    <div class="contenido-principal">
        <div class="catalogo" id="catalogo">
        @foreach ($productos as $producto)
            <div class="producto" 
                onclick="mostrarDetalles('{{ $producto->getNombre() }}', '{{ $producto->getPrecio() }}', '{{ $producto->getImagenUrl() }}', 
                '{{ $producto->getStock36() }}', '{{ $producto->getStock38() }}', '{{ $producto->getStock40() }}',
                '{{ $producto->getStock42() }}', '{{ $producto->getStock44() }}')">
                <img src="{{ $producto->getImagenUrl() }}" alt="{{ $producto->getNombre() }}">
                <h3>{{ $producto->getNombre() }}</h3>
                <p>Precio: Bs {{ number_format($producto->getPrecio(), 2) }}</p>
            </div>
        @endforeach
    </div>


        <div class="detalles-producto" id="detalles-producto">
            <img id="imagen-detalle" src="" alt="Detalles del Producto">
            <h2 id="nombre-detalle"></h2>
            <p id="precio-detalle"></p>
            <div id="detalles-tallas"></div> <!-- Contenedor de tallas -->
            <div>
                <button class="boton" onclick="comprarAhora()">Comprar Ahora</button>
                <button class="boton boton-secundario" onclick="añadirAlCarrito(productoActual.nombre, productoActual.precio)">Agregar al Carrito</button>
                <button class="boton" onclick="volverAlCatalogo()">Volver</button>
            </div>
        </div>

        <div class="pantalla-compra" id="pantalla-compra">
            <h2>Finalizar Compra</h2>
            <div class="metodos-pago">
                <button class="boton" onclick="pagarTarjeta()">Pagar con Tarjeta</button>
                <button class="boton boton-secundario" onclick="pagarQR()">Pagar con QR</button>
            </div>
            <button class="boton" onclick="volverAlDetalles()">Volver</button>
        </div>

        <div class="carrito">
            <h2>Carrito de Compras</h2>
            <ul id="lista-carrito"></ul>
            <p>Total: Bs <span id="total-carrito">0.00</span></p>
            <button onclick="procesarCompra()" class="boton">Procesar Compra</button>
        </div>
    </div>

    <footer>
        <p>© 2024 Tienda de Zapatillas. Todos los derechos reservados.</p>
    </footer>
</x-layout>

<script>
    let carrito = [];
    let total = 0;
    let productoActual = null;

    function mostrarDetalles(nombre, precio, imagen, stock36, stock38, stock40, stock42, stock44) {
        document.getElementById('catalogo').style.display = 'none';
        const detallesProducto = document.getElementById('detalles-producto');
        detallesProducto.style.display = 'flex';

        document.getElementById('imagen-detalle').src = imagen;
        document.getElementById('nombre-detalle').textContent = nombre;
        document.getElementById('precio-detalle').textContent = "Bs. "+precio;

        // Mostrar las tallas disponibles
        const tallas = [36, 38, 40, 42, 44];
        const stocks = [stock36, stock38, stock40, stock42, stock44];
        
        const detallesTallas = document.getElementById('detalles-tallas');
        detallesTallas.innerHTML = ''; // Limpiar las tallas previas

        // Crear los botones de tallas
        tallas.forEach((talla, index) => {
            const stock = parseInt(stocks[index]);
            const button = document.createElement('button');
            button.textContent = talla;
            button.classList.add('talla-button');

            // Si el stock es mayor a 0, habilitamos el botón, sino lo deshabilitamos
            if (stock > 0) {
                button.disabled = false;
                button.onclick = () => seleccionarTalla(talla);
            } else {
                button.disabled = true;
            }

            detallesTallas.appendChild(button);
        });

        productoActual = { nombre, precio, imagen };
    }

    function seleccionarTalla(talla) {
        console.log(`Talla seleccionada: ${talla}`);
        // Aquí puedes agregar la lógica para procesar la selección de la talla
    }



    function volverAlCatalogo() {
        document.getElementById('catalogo').style.display = 'grid';
        document.getElementById('detalles-producto').style.display = 'none';
        document.getElementById('pantalla-compra').style.display = 'none';
    }

    function comprarAhora() {
        document.getElementById('detalles-producto').style.display = 'none';
        document.getElementById('pantalla-compra').style.display = 'flex';
    }

    function volverAlDetalles() {
        document.getElementById('detalles-producto').style.display = 'flex';
        document.getElementById('pantalla-compra').style.display = 'none';
    }

    function pagarTarjeta() {
    enviarPedido("tarjeta");
    }

    function pagarQR() {
        enviarPedido("QR");
    }

    function enviarPedido(metodoPago) {
        if (!productoActual) {
            alert('No se ha seleccionado ningún producto');
            return;
        }

        // Información del pedido
        console.log(productoActual.precio);
        
        const pedido = {
            estado: "pagado",
            nroTransaccion: "555555",
            total: productoActual.precio,
            tipoPago: metodoPago,
            productos: [
                {
                    nombre: productoActual.nombre,
                    precio: productoActual.precio,
                },
            ],
        };

        // Enviar solicitud POST al servidor
        fetch('/pedido/create', {
            method: 'POST',
            body: JSON.stringify(pedido),
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al guardar el pedido');
                }
            })
            .then(data => {
                alert('Pedido guardado exitosamente');
                console.log(data);
                volverAlCatalogo(); // Volver al catálogo después de guardar el pedido
            })
            .catch(error => {
                console.error(error);
                alert('Hubo un problema al procesar el pedido');
            });
    }



    function añadirAlCarrito(nombre, precio) {
        carrito.push({ nombre, precio });
        total += precio;
        actualizarCarrito();
    }

    function actualizarCarrito() {
        const listaCarrito = document.getElementById('lista-carrito');
        listaCarrito.innerHTML = '';
        carrito.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `${item.nombre} - Bs ${item.precio.toFixed(2)}`;
            listaCarrito.appendChild(li);
        });
        document.getElementById('total-carrito').textContent = total.toFixed(2);
    }

    function procesarCompra() {
        alert('Compra procesada');
        carrito = [];
        total = 0;
        actualizarCarrito();
    }
</script>
</body>
</html>
