function ActualizarEdad()
{
    edad = CalcularEdad($("#FechaNacimiento").val());
    $("#Edad").val(edad);
}


function CalcularEdad(FechaNacimiento)
{
    var hoy = new Date();
    var cumpleanos = new Date(FechaNacimiento);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}
