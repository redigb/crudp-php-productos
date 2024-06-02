<div class="container is-max-desktop is-mobile fondo pt-6" id="form-container">
    <!--<h2 class="font-bold text-2xl is-size-3 has-text-centered">😶‍🌫️ Registro de Categorias 📄</h2>
 Vista de tabla -->



    <div class=" p-6 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <a class="button is-ghost" href="<?=APP_URL?>categorias/"> <-- Regresar </a>
                        <form class="flex items-center justify-center FormularioAjax" action="<?=APP_URL?>App/ajax/categoriaAjax.php" 
                        method="POST">
                            <input type="hidden" name="modulo_categoria" value="registrar">
                            <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
                                <div class="p-6">
                                    <div class="space-y-8">
                                        <div class="space-y-2">
                                            <h2 class="title is-size-3 has-text-centered">🅰️ Nueva de Categoria + 📄</h2>
                                        </div>
                                        <div class="space-y-4">
                                            <!--<div class="grid grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="first-name">
                                                First name
                                            </label>
                                            <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="first-name" placeholder="Enter your first name" />
                                        </div>
                                       <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="last-name">
                                                Last name
                                            </label>
                                            <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="last-name" placeholder="Enter your last name" />
                                        </div> 
                                    </div> -->
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                                                    Categoria
                                                </label>
                                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
                                                type="text" id="categoria_nombre" name="categoria_nombre" placeholder="Nombre de la categoria" />
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">
                                                    Ubicacion
                                                </label>
                                                <input class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" 
                                                type="text" id="categoria_ubicacion" name="categoria_ubicacion" placeholder="Ubicacion de la categoria" />
                                            </div>
                                            <!-- <div class="space-y-2">
                                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                            Pronoun
                                        </label>
                                        <button type="button" role="combobox" aria-controls="radix-:R2eulafnnja:" aria-expanded="false" aria-autocomplete="none" dir="ltr" data-state="closed" data-placeholder="" class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" aria-label="Pronoun">
                                            <span style="pointer-events:none">Select your pronoun</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down h-4 w-4 opacity-50" aria-hidden="true">
                                                <path d="m6 9 6 6 6-6"></path>
                                            </svg>
                                        </button>
                                        <select aria-hidden="true" tabindex="-1" style="position:absolute;border:0;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;word-wrap:normal">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="message">
                                            Message
                                        </label>
                                        <textarea class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[100px]" id="message" placeholder="Enter your message"></textarea>
                                    </div> -->
                                            <button class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-700 h-10 px-4 py-2 bg-gray-800 text-white" type="submit">
                                                Crear categoria
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