# form-valid
*Escribe un programa PHP que permita al usuario rellenar un formulario de registro con los datos de nombre, contraseña, fecha de nacimiento, telefono, tienda, edad y suscripción. 
Los datos introducidos deben de respetar ciertas reglas de validación que se comprobarán en el servidor con las funciones filter_input y filter_var. Las reglas son las siguientes:
1. El nombre nombre se compone de 3 a 25 caracteres con mayúsculas y minúsculas y espacios en blanco.
2. La contraseña contiene de 6 a 8 caracteres con mayúsculas, minúsculas, digitos y los símbolos !@#$%^&*()+
3. El correo electrónico ha de tener el formato correcto.
4. El teléfono ha de tener el formato correcto.
4. La edad debe tener un valor comprendido entre el 18 y el 120.
El script recibe los datos del formulario y los muestra en una tabla con los valores tal y como los escribió el usuario después de aplicar el filtro de saneamiento que corresponda al dato solicitado 
  y en el caso de que no sea un valor válido un mensaje informando de que el dato es inválido*
