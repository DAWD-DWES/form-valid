<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Registro</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta nombre="viewport" content="width=device-width">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <?php if (!filter_has_var(INPUT_POST, "enviar")): ?> <!-- Si se solicita el formulario -->
            <div class="flex-page">
                <h1>Customer Registration</h1>
                <form class="capaform" nombre="registerform" 
                      action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" novalidate>
                    <div class="flex-outer">
                        <div class="form-section">
                            <label for="nombre">Nombre:</label> 
                            <input id="nombre" type="text" name="nombre" placeholder="Introduce el nombre" />
                        </div>
                        <div class="form-section">
                            <label for="clave">Clave:</label> 
                            <input id="clave" type="password" name="clave" placeholder="Introduce la clave" />
                        </div>
                        <div class="form-section">
                            <label for="correo">Correo:</label>
                            <input id="correo" type="text"  name="correo" placeholder="Introduce el correo"  />
                        </div>
                        <div class="form-section">
                            <label for="fechanac">Fecha de nacimiento:</Label>
                            <input id="fechanac" type="date" name="fechanac" placeholder="Introduce la fecha de nacimiento" />
                        </div>
                        <div class="form-section">
                            <label for="telefono">Teléfono:</Label> 
                            <input id="telefono" type="tel" name="tel" placeholder="Introduce el teléfono" />
                        </div>
                        <div class="form-section">
                            <label for="tienda">Tienda Preferida:</Label> 
                            <select id="tienda" name="tienda">
                                <option value="Madrid">Madrid</option>
                                <option value="Barcelona">Barcelona</option>
                                <option value="Valencia">Valencia</option>
                            </select> 
                        </div>
                        <div class="form-section">
                            <label for="edad">Edad:</label> 
                            <input id="edad" type="number" name="edad" placeholder="Introduce tu edad" />
                        </div>
                        <div class="form-section">
                            <label>Idioma preferido:</label>
                            <div class="select-section">
                                <div>
                                    <input id="español" type="radio" name="idioma" value="español" /> 
                                    <label for="español">Español</label>
                                </div>
                                <div>
                                    <input id="inglés" type="radio" name="idioma" value="inglés" /> 
                                    <label for="inglés">Inglés</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <label for="suscripcion">Suscripción revista:</label>
                            <input id="suscripcion" type="checkbox"  name="suscripcion" /> 
                        </div>
                        <div class="form-section">
                            <div class="submit-section">
                                <input class="submit" type="submit" 
                                       value="Enviar" name="enviar" /> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php else: ?> <!-- Si se solicita el resultado de validar los datos introducidos en el formulario -->
            <div class="summary-section">
                <h1>Datos del cliente</h1>
                <table>
                    <tr>
                        <th>Campo</th>
                        <th>Valor</th>
                        <th>Valor saneado lectura</th>
                        <th>Valor válido/ No válido</th>
                        <th>Valor htmlspecialchars</th>
                    </tr>
                </table>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="submit">Volver al formulario</a>
            </div>
        <?php endif ?>
    </body>
</html>