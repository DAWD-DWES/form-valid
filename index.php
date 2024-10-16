<?php
define("RUTA_IMAGENES", "imagenes");
if (filter_has_var(INPUT_POST, "enviar")) {
    $datos = [];
// Lectura, saneamiento y validación del dato de nombre
// 3 a 25 caracteres en mayúsculas y minúsculas y espacio en blanco
    $nombre = [];
    $nombre['form'] = filter_input(INPUT_POST, 'nombre', FILTER_UNSAFE_RAW);
    $nombre['san'] = filter_var($nombre['form'], FILTER_SANITIZE_SPECIAL_CHARS);
    $nombre['err'] = filter_var($nombre['san'], FILTER_VALIDATE_REGEXP,
                    ['options' => ['regexp' => "/^[a-z A-Záéíóúñ]{3,25}$/"]]) === false;

    $datos['nombre'] = $nombre;
    // Lectura y validación del dato de DNI
    $dni = [];
    $dni['form'] = filter_input(INPUT_POST, 'dni', FILTER_UNSAFE_RAW);
    $dni['san'] = filter_var($dni['form'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dni['err'] = filter_var($dni['san'], FILTER_VALIDATE_REGEXP,
                    ['options' => ['regexp' => "/^[1-9][0-9]{7}[A-Z]$/"]]) === false ||
            (substr($dni['san'], 8) != substr("TRWAGMYFPDXBNJZSQVHLCKE", ((int) substr($dni['san'], 0, 8) % 23), 1));
    $datos['dni'] = $dni;

// Lectura, saneamiento y validación del dato de contraseña
// 6 a 8 caracteres con mayúsculas, minúsculas, digitos y los símbolos !@#$%^&*()+

    $clave = [];
    $clave['form'] = filter_input(INPUT_POST, 'clave', FILTER_UNSAFE_RAW);
    $clave['san'] = filter_var($clave['form'], FILTER_SANITIZE_SPECIAL_CHARS);
    $clave['err'] = filter_var($clave['san'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => "/^[\w!@#\$%\^&\*\(\)\+]{6,8}$/"]]) === false;

    $datos['clave'] = $clave;
// Lectura, saneamiento y validación del dato de correo
// Formato correcto de correo

    $correo = [];
    $correo['form'] = filter_input(INPUT_POST, 'correo', FILTER_UNSAFE_RAW);
    $correo['san'] = filter_var($correo['form'], FILTER_SANITIZE_EMAIL);
    $correo['err'] = filter_var($correo['san'], FILTER_VALIDATE_EMAIL) === false;

    $datos['correo'] = $correo;
// Lectura del dato de fecha. La fecha ya viene validada del formulario

    $fechaNac = [];
    $fechaNac['form'] = filter_input(INPUT_POST, 'fechanac', FILTER_UNSAFE_RAW);
    /*  $fechaNacError = filter_input(INPUT_POST, 'campo', FILTER_VALIDATE_REGEXP, [
      "options" => ["regexp" => "/^.+$/"]]) === false; */
    $fechaNac['err'] = empty($fechaNac['form']);

// Lectura, saneamiento y validación del dato de telefono
// Números sin blancos    

    $tel = [];
    $tel['form'] = filter_input(INPUT_POST, 'tel', FILTER_UNSAFE_RAW);
    $tel['san'] = filter_var($tel['form'], FILTER_SANITIZE_NUMBER_INT);
    $tel['err'] = (strlen($tel['san']) < 8 || strlen($tel['san']) > 11);

    $datos['tel'] = $tel;
// Lectura del dato de tienda
    $tienda = [];
    $tienda['form'] = filter_input(INPUT_POST, 'tienda');

    $datos['tienda'] = $tienda;
// Lectura, saneamiento y validación del dato de edad. Solo pueden acceder mayores de edad

    $edad = [];

    $edad['form'] = filter_input(INPUT_POST, 'edad', FILTER_UNSAFE_RAW);
    $edad['san'] = filter_var($edad['form'], FILTER_SANITIZE_NUMBER_INT);
    $edad['err'] = filter_var($edad['san'], FILTER_VALIDATE_INT, [
                "options" => [
                    "min_range" => 18,
                    "max_range" => 120,
                ]
            ]) === false;

    $datos['edad'] = $edad;

// Lectura del dato de idioma.
    $idioma = [];

    $idioma['form'] = filter_input(INPUT_POST, 'idioma', FILTER_UNSAFE_RAW);
    $idioma['err'] = empty($idioma['form']);

    $datos['idioma'] = $idioma;

    // Lectura del dato de intereses
    $intereses = [];
    $intereses['form'] = implode(', ', filter_input(INPUT_POST, 'intereses', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? []);
    $datos['intereses'] = $intereses;

// Validación del dato de suscripcion. Se convierte la respuesta a un valor booleano
    $suscripcion = [];

    $suscripcion['form'] = filter_input(INPUT_POST, 'suscripcion', FILTER_VALIDATE_BOOLEAN) ?? false;
    $suscripcion['san'] = $suscripcion['form'] ? 'si' : 'no';

    $datos['suscripcion'] = $suscripcion;

    // Validación y carga de la imagen
    $foto = $_FILES['foto'];
    $foto['err'] = false;

    // Verifica que el archivo sea de tipo JPEG o JPG
    if ($foto['error'] == UPLOAD_ERR_OK) {
        $foto['form'] = $foto['name'];
        $fileType = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        if (!$dni['err'] ?? false) {
            if (in_array($fileType, ['jpg', 'jpeg'])) {
                $destino = RUTA_IMAGENES . "/" . $dni['san'] . ".$fileType";
                move_uploaded_file($foto['tmp_name'], $destino);
            } else {
                $foto['err'] = true; // Error si no es jpg/jpeg
            }
        }
    } else {
        $foto['err'] = true; // Error si hubo algún problema con la carga
    }

    $datos['foto'] = $foto;
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
            <div class="flex-page">
                <h1>Customer Registration</h1>
                <form class="capaform" nombre="registerform" 
                      action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" 
                      enctype="multipart/form-data" novalidate>
                    <div class="flex-outer">
                        <div class="form-section">
                            <label for="nombre">Nombre:</label> 
                            <input id="nombre" type="text" name="nombre" placeholder="Introduce el nombre" />
                        </div>
                        <div class="form-section">
                            <label for="dni">DNI:</label>
                            <input id="dni" type="text" name="dni" placeholder="Introduce el DNI (12345678A)" />
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
                            <label for="telefono">Teléfono:</Label> 
                            <input id="telefono" type="tel" name="tel" placeholder="Introduce el teléfono" />
                        </div>
                        <div class="form-section">
                            <label for="edad">Edad:</label> 
                            <input id="edad" type="number" name="edad" placeholder="Introduce tu edad" />
                        </div>
                        <div class="form-section">
                            <label for="fechanac">Fecha de nacimiento:</Label>
                            <input id="fechanac" type="date" name="fechanac" placeholder="Introduce la fecha de nacimiento" />
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
                            <label>Intereses:</label>
                            <div class="select-section">
                                <div>
                                    <input id="deportes" type="checkbox" name="intereses[]" value="deportes" />
                                    <label for="deportes">Deportes</label>
                                </div>
                                <div>
                                    <input id="musica" type="checkbox" name="intereses[]" value="musica" />
                                    <label for="musica">Música</label>
                                </div>
                                <div>
                                    <input id="lectura" type="checkbox" name="intereses[]" value="lectura" />
                                    <label for="lectura">Lectura</label>
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
                        <div class="form-section">
                            <label for="foto">Foto:</label>
                            <input id="foto" type="file" name="foto" accept=".jpg, .jpeg" />
                        </div>
                    </div>
                </form>
            </div>
        <?php else: ?> <!-- Si se solicita el resultado de validar los datos introducidos en el formulario -->
            <div class="summary-section">
                <h1>Datos del cliente</h1>
                <?php if (!$dni['err'] ?? false): ?>
                    <div class="foto-container">
                        <img src= "<?= $destino ?>" alt="Foto del usuario" class="foto-usuario">
                    </div>
                <?php endif ?>
                <table class="valores">
                    <tr>
                        <th>Campo</th>
                        <th>Valor</th>
                        <th>Valor saneado lectura</th>
                        <th>Valor válido/ No válido</th>
                        <th>Valor htmlspecialchars</th>
                    </tr>
                    <?php foreach ($datos as $dato => $valores): ?>
                        <tr>
                            <td><?= $dato ?></td>
                            <td><?= $valores['form'] ?? '' ?></td>
                            <td><?= $valores['san'] ?? '' ?></td>
                            <td><?= ($valores['err'] ?? false) ? "$dato no es válido" : "$dato es válido" ?></td>
                            <td><?= htmlspecialchars($valores['form'] ?? '') ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" class="submit">Volver al formulario</a>
            </div>
        <?php endif ?>
    </body>
</html>