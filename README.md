# form valid
Estudia y escribe un programa PHP parecido a este programa que permita al usuario rellenar un formulario con
distintos tipos de campos y con reglas de validación asociadas. 

Este programa permita al usuario rellenar un formulario de registro con los datos de nombre, contraseña, fecha de nacimiento, telefono, edad, tienda, intereses y suscripción.
Los datos introducidos deben de respetar ciertas reglas de validación que se comprobarán en el servidor con las funciones filter_input y filter_var. Las reglas son las siguientes:
Todos los campos son requeridos y deben ser rellenados.
1. El nombre nombre se compone de 3 a 25 caracteres con mayúsculas y minúsculas y espacios en blanco.
2. DNI del usuario se compone de 9 dígitos y una letra. La letra se obtiene calculando el módulo del número de DNI entre 23.
3. La contraseña contiene de 6 a 8 caracteres con mayúsculas, minúsculas, digitos y los símbolos !@#$%^&*()+
4. El correo electrónico ha de tener el formato correcto.
5. El teléfono ha de tener el formato correcto.
6. La edad debe tener un valor comprendido entre el 18 y el 120.
7. La fecha de nacimiento debe de tener el formato correcto. El elemento del formulario ya captura la edad en el formato correcto.
8. La tienda ya viene de manera correcta desde el formulario según la opción elegida.
9. El idioma ya viene de manera correcta desde el formulario según la opción elegida.
10. Los intereses viajan como un array de valores que hay que convertir a una cadena. No es necesario marcar alguna opción.
11. La suscripción a la revista ya viene de manera correcta desde el formulario.
12. Foto del usuario. El fichero de la foto debe tener extensión jpg y jpeg.

El script recibe los datos del formulario y los muestra en una tabla con los valores tal y como los escribió el usuario,
 después de aplicar el filtro de saneamiento que corresponda al dato solicitado,
  y en el caso de que no sea un valor válido un mensaje informando de que el dato es inválido.
Las dos páginas de la aplicación, formulario y la tabla resumen se construyen con el mismo script.


