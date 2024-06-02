<div class="container is-max-desktop is-mobile fondo pt-6" id="form-container">
    <!--<h2 class="font-bold text-2xl is-size-3 has-text-centered">😶‍🌫️ Registro de Categorias 📄</h2>
 Vista de tabla -->
    <div>
        <h2 class="title is-size-3 has-text-centered">📦 Productos 📄</h2>
    </div>

    <div class="w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Tabla de productos</h1>
            <!-- <a href="form-categoria/">   </a> -->
            <button class="button is-primary text-white js-modal-trigger" data-target="modal-js">
                añadir nuevo producto ->
            </button>
        </div>
        <div class="overflow-hidden">
            <div class="relative w-full overflow-auto">
                <table class="border table container">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre Producto</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Tamaño</th>
                            <th>Color</th>
                            <th>Fecha creada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-productos">
                        <!--  <tr>
                            <td>38</td>
                            <td>23</td>
                            <td>12</td>
                            <td>3</td>
                            <td>68</td>
                        </tr> -->
                </table>
            </div>
        </div>
    </div>
    <!-- Modal insertar producto -->
    <div id="modal-js" class="modal">
        <div class="modal-background"> <button class="modal-close is-large" aria-label="close"></button></div>
        <div class="modal-content">
            <div class="p-6 flex items-center justify-center">
                <div class="container max-w-screen-lg mx-auto">
                    <div class="bg-white  rounded-lg border bg-card text-card-foreground ">
                        <form class="flex items-center justify-center FormularioAjax" action="<?= APP_URL ?>App/ajax/productoAjax.php" method="POST">
                            <input type="hidden" name="modulo_producto" value="registrar">
                            <div>
                                <div class="p-6">
                                    <div class="space-y-8">
                                        <div class="space-y-2">
                                            <h2 class="title is-size-3 has-text-centered">✏️ Nuevo Producto + 📄</h2>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="first-name">
                                                    Nombre Producto
                                                </label>
                                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="nombre_producto" name="nombre_producto" placeholder="Ingrese el nombre del producto" />
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="message">
                                                    Descripcion del producto
                                                </label>
                                                <textarea class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[100px]" id="otros_datos" name="otros_datos" placeholder="descripcion del producto"></textarea>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                        Categoria
                                                    </label>
                                                    <div class="select">
                                                        <select name="categoria_selecion" id="categoria_selecion"></select>
                                                    </div>
                                                </div>
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                        Tamaño
                                                    </label>
                                                    <div class="select">
                                                        <select name="medida_selecion" id="medida_selecion"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="label text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                    Color
                                                </label>
                                                <div class="select">
                                                    <select name="color_selecion" id="color_selecion"></select>
                                                </div>
                                            </div>
                                            <button class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-700 h-10 px-4 py-2 bg-gray-800 text-white" type="submit">
                                                Registrar Producto
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal editar producto -->
    <div id="modal-js-editar" class="fixed inset-0 hidden items-center justify-center bg-gray-800 bg-opacity-75">
        <div class="bg-white rounded-lg shadow-lg w-4/12 relative">
            <div class="p-4">
                <!-- Mover el botón de cerrar a la esquina superior derecha -->
                <button class="modal-close text-2xl text-gray-600 hover:text-red-500 absolute top-4 right-4">X</button>
                <form class="w-full flex items-center justify-center FormularioAjax" action="<?= APP_URL ?>App/ajax/productoAjax.php" method="POST">
                    <input type="hidden" name="modulo_producto" value="actulizar">
                    <input id="id_ProductEdit" name="id_ProductEdit" type="hidden">
                    <div>
                        <div class="p-6">
                            <div class="space-y-8">
                                <div class="space-y-2">
                                    <h2 class="title is-size-3 has-text-centered">✏️ Editar Producto + 📄</h2>
                                </div>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="first-name">
                                            Nombre Producto
                                        </label>
                                        <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
                                        id="nombre_producto_editar" type="text" name="nombre_producto_editar" placeholder="Ingrese el nombre del producto" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="message">
                                            Descripcion del producto
                                        </label>
                                        <textarea class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[100px]" id="otros_datos_editar" name="otros_datos_editar" placeholder="descripcion del producto"></textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                Categoria
                                            </label>
                                            <div class="select">
                                                <select name="categoriaSelect" id="categoriaSelect">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                                Tamaño
                                            </label>
                                            <div class="select">
                                                <select name="medida_selecionEdit" id="medida_selecionEdit">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="label text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                            Color
                                        </label>
                                        <div class="select">
                                            <select name="color_selecionEdit" id="color_selecionEdit">
                                            </select>
                                        </div>
                                    </div>
                                    <button class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-700 h-10 px-4 py-2 bg-gray-800 text-white" type="submit">
                                        Actualizar Producto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-js-editar" class="modal">
        <div class="modal-background"> <button class="modal-close is-large" aria-label="close"></button></div>
        <div class="modal-content">
            <div class="p-6 flex items-center justify-center">
                <div class="container max-w-screen-lg mx-auto">
                    <div class="bg-white  rounded-lg border bg-card text-card-foreground ">

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>