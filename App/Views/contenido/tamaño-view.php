<div class="container is-max-desktop is-mobile fondo pt-6" id="form-container">
    <!--<h2 class="font-bold text-2xl is-size-3 has-text-centered">😶‍🌫️ Registro de Categorias 📄</h2>
 Vista de tabla -->
    <div>
        <h2 class="title is-size-3 has-text-centered">🎢 Tamaño 📄</h2>
    </div>

    <div class="w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Lsitado de tamaño</h1>
            <!-- <a href="form-categoria/">   </a> -->
            <button class="button is-primary text-white js-modal-trigger" data-target="modal-js">
                añadir tamaño ->
            </button>
        </div>
        <div class="overflow-hidden">
            <div class="relative w-full overflow-auto">
                <table class="border table container">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Codigo Tamaño</th>
                            <th>Clasificacion</th>
                            <th>Fecha creada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-medidas">
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

    <div id="modal-js" class="modal">
        <div class="modal-background"> <button class="modal-close is-large" aria-label="close"></button></div>
        <div class="modal-content">
            <div class="p-6 flex items-center justify-center">
                <div class="container max-w-screen-lg mx-auto">
                    <div class="bg-white  rounded-lg border bg-card text-card-foreground ">
                        <form class="flex items-center justify-center FormularioAjax" action="<?= APP_URL ?>App/ajax/medidaAjax.php" method="POST">
                            <input type="hidden" name="modulo_tamaño" value="registrar">
                            <div>
                                <div class="p-6">
                                    <div class="space-y-8">
                                        <div class="space-y-2">
                                            <h2 class="title is-size-3 has-text-centered">✏️ Nuevo Tamaño + 📄</h2>
                                        </div>
                                        <div class="space-y-4">

                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                                                    Codigo Tamaño
                                                </label>
                                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
                                                type="text" id="codigo_tamaño" name="codigo_tamaño" placeholder="Codigo del tamaño" />
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                                                    Clasificacion
                                                </label>
                                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
                                                type="text" id="clasificacion" name="clasificacion" placeholder="Clasificacion del tamaño" />
                                            </div>

                                            <button class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-700 h-10 px-4 py-2 bg-gray-800 text-white" type="submit">
                                                Crear tamaño
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
</div>