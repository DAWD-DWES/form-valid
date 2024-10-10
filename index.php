<?php
if (filter_has_var(INPUT_POST, "enviar")) {

// Lectura, saneamiento y validación del dato de nombre
// 3 a 25 caracteres en mayúsculas y minúsculas y espacio en blanco

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW);
    $nombreError = filter_var($nombre, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[a-z A-Z]{3,25}$/"]]) === false;

// Lectura, saneamiento y validación del dato de contraseña
// 6 a 8 caracteres con mayúsculas, minúsculas, digitos y los símbolos !@#$%^&*()+

    $clave = filter_input(INPUT_POST, 'clave', FILTER_UNSAFE_RAW);
    $claveError = filter_var($clave, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[\w!@#\$%\^&\*\(\)\+]{6,8}$/"]]) === false;

// Lectura, saneamiento y validación del dato de correo
// Formato correcto de correo

    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $correoError = filter_var($correo, FILTER_VALIDATE_EMAIL) === false;

// Lectura del dato de fecha. La fecha ya viene validada del formulario

    $fechaNac = filter_input(INPUT_POST, 'fechanac', FILTER_UNSAFE_RAW);
    $fechaNacError = empty($fechaNac);

// Lectura, saneamiento y validación del dato de telefono
// Números sin blancos    

    $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
    $telError = filter_var($tel, FILTER_VALIDATE_INT) === false;

// Lectura del dato de tienda
    $tienda = filter_input(INPUT_POST, 'tienda');

// Lectura, saneamiento y validación del dato de edad. Solo pueden acceder mayores de edad

    $edad = filter_input(INPUT_POST, 'edad', FILTER_UNSAFE_RAW);
    $edadError = is_null($edad);

// Validación del dato de suscripcion. Se convierte la respuesta a un valor booleano
    $suscripcion = filter_input(INPUT_POST, 'suscripcion', FILTER_VALIDATE_BOOLEAN) ?? false;
}
?>

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
            <div class="flex-pedad">
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
                            <input id="clave" type="clave" name="clave" placeholder="Introduce la clave" />
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
                            <label>Age:</label>
                            <div class="select-section">
                                <div>
                                    <input id="-25" type="radio" name="edad" value="-25" /> 
                                    <label for="-25">Más joven de 25</label>
                                </div>
                                <div>
                                    <input id="25-50" type="radio" name="edad" value="25-50" /> 
                                    <label for="25-50">Entre 25 y 50</label>
                                </div>
                                <div>
                                    <input id="50-" type="radio" name="edad" value="50-" />
                                    <label for="50-">Mayor de 50</label>
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
                <p><?= ($nombreError) ? "Nombre no es válido" : "Nombre: $nombre" ?></p>
                <p><?= ($claveError) ? "Clave no es válida" : "Clave: $clave" ?></p>
                <p><?= ($correoError) ? "Correo no es válido" : "Correo: $correo" ?></p>
                <p><?= ($fechaNacError) ? "Fecha de nacimiento no es válida" : "Fecha de naimiento: $fechaNac" ?></p>
                <p><?= ($telError) ? "Telefono no es válido" : "Teléfono: $tel" ?></p>
                <p>Shop: <?= $tienda ?></p>
                <p><?=
                    ($edadError) ? "Información sobre la edad no introducida" : "Edad: " .
                            match ($edad) {'-25' => "Más joven de 25", '25-50' => "Entre 25 y 50", '50+' => "Mayor de 50"
                            }
                    ?></p>
                <p>Suscripción: <?= ($suscripcion) ? "Suscrito" : "No suscrito" ?>
            </div>
        <?php endif ?>
    </body>
</html>


