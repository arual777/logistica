function desactivar() {
    document.getElementById("codigoLicencia").disabled = true;
    document.getElementById("tipoLicencia").disabled = true;
}

function activar() {
    document.getElementById("codigoLicencia").disabled = false;
    document.getElementById("tipoLicencia").disabled = false;
    document.getElementById("codigoLicencia").focus();
    document.getElementById("tipoLicencia").focus();
}