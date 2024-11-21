// ---------- Permisos -----------

function validarHora(input) {
    const fecini = new Date(document.getElementById("fecini").value);
    const fecfin = new Date(document.getElementById("fecfin").value);
    const selectedDate = new Date(input.value);
    const horaini = fecini.getHours();
    const horafin = fecfin.getHours();
    const minini = fecini.getMinutes();
    const minfin = fecfin.getMinutes();
    const hora = selectedDate.getHours();
    const minutos = selectedDate.getMinutes();
    
    let errorMessageId = (input.id === "fecini") ? "error-message-fecini" : "error-message-fecfin";
    const errorMessage = document.getElementById(errorMessageId);
    const submitBtn = document.getElementById("btns");

    // Validar que la hora esté entre 8:00 AM y 5:30 PM
    if (hora < 8 || (hora === 17 && minutos > 30) || hora > 17) {
        input.style.borderColor = "red";
        errorMessage.textContent = "La hora debe estar entre las 8:00 AM y las 5:30 PM.";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si hay un error
    } else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }

    // Validar que la hora esté en intervalos de 30 minutos
    if (minutos % 30 !== 0) {
        input.style.borderColor = "red";
        errorMessage.textContent = "La hora debe estar en intervalos de 30 minutos.";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si hay un error
    } else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }

    // Validar que fecfin no sea menor que fecini
    if (fecfin.getTime() < fecini.getTime()) {
        input.style.borderColor = "red";
        errorMessage.textContent = "La fecha final no puede ser menor que la fecha inicial.";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si hay un error
    } else if (fecfin.getTime() === fecini.getTime()){
        input.style.borderColor = "red";
        errorMessage.textContent = "Las fechas no pueden ser iguales.";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si hay un error
    }else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }

    if ((hora === 13 && (minutos > 0 && minutos <= 59))) {
        input.style.borderColor = "red";
        errorMessage.textContent = "Es hora de almuerzo (1:00 PM - 2:00 PM).";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si hay un error
    } else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }

    // Verificar si es hora de almuerzo (entre 1:00 PM y 2:00 PM)
    if ((horaini === 13 && (minini>=0 && minini<=59)) && ((horafin === 14 && minfin === 0) || (horafin === 13 && minfin>=0 && minfin<=59))) {
        input.style.borderColor = "red";
        errorMessage.textContent = "Es hora de almuerzo (1:00 PM - 2:00 PM).";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return; // Salir si es hora de almuerzo
    } else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }

    // Validar jornada laboral
    const diffMs = fecfin - fecini; // Diferencia en milisegundos
    const diffHrs = Math.floor(diffMs / 3600000); // Horas
    const diffMins = Math.floor((diffMs % 3600000) / 60000); // Minutos

    // Calcular duración ajustada
    let totalMinutes = (diffHrs * 60 + diffMins);
    
    // Restar 1 hora si se aplica
    if (hora < 13 || hora > 14) {
        totalMinutes -= 60; // Restar 1 hora
    }

    // Verificar si la duración total supera las 8 horas y 30 minutos
    if (totalMinutes > (8 * 60 + 30)) { // 8 horas y 30 minutos en minutos
        input.style.borderColor = "red";
        errorMessage.textContent = "El permiso no puede ser mayor a la jornada laboral.";
        errorMessage.style.display = "block";
        submitBtn.disabled = true;
        return;
    } else {
        input.style.borderColor = "";
        errorMessage.style.display = "none";
        submitBtn.disabled = false;
    }
}

function validarPermiso() {
    const select = document.getElementById("idvtprm");
    const soporte = document.getElementById("arcspt");
    const msj = document.getElementById("soporte-requerido");
    const fecini = document.getElementById("fecini");
    const fecfin = document.getElementById("fecfin");
    const valor = select.value;
    
    const valorsoporte = ["41", "44"];
    const hoy = new Date();
    const fechaMin = new Date(hoy);
    
    fechaMin.setDate(hoy.getDate() + (select.value == "43" ? 0 : 1)); // Sumar 0 días para hoy, 1 días para mañana
    const fechaMinString = fechaMin.toISOString().split("T")[0] + "T08:00"; // Formato YYYY-MM-DDT08:00

    // Establecer el mínimo en los inputs
    fecini.setAttribute("min", fechaMinString);
    fecfin.setAttribute("min", fechaMinString);

    // Validar si el permiso requiere soporte
    if (valorsoporte.includes(valor)) {
        soporte.setAttribute("required", "required");
        msj.style.display = "block";
    } else {
        soporte.removeAttribute("required");
        msj.style.display = "none";
    }
}

function actualizarMinMax() {
    const fecini = document.getElementById('fecini').value;
    const fecfin = document.getElementById('fecfin');

    if (fecini) {
        // Fijar el mínimo en fecfin al mismo valor que fecini
        fecfin.min = fecini;

        // Fijar el máximo para que sea el mismo día, pero hasta las 6:00 PM
        let maxDate = new Date(fecini);
        maxDate.setHours(17, 30, 0); // Fijar a las 5:30 PM
        fecfin.max = maxDate.toISOString().slice(0, 16); // Convertir a formato datetime-local
    }
}

function actMinMax() {
    const fecinib = document.getElementById('fecinib').value;
    const fecfinb = document.getElementById('fecfinb');

    if (fecinib){
        fecfinb.min = fecinib;
    }
}

function enter(event) {
    // Verificar si la tecla presionada es "Enter"
    if (event.key === 'Enter') {
        // Enviar el formulario
        document.getElementById('ndper').form.submit();
        return false; // Evitar que se agregue un salto de línea al presionar "Enter"
    }
    return true;
}

function contar() {
    const textarea = document.getElementById('desprm');
    const boton = document.getElementById('btns');
    const mensaje = document.getElementById('error-message-des');

    const longitud = textarea.value.length;

    if (longitud <= 20) {
        textarea.style.borderColor = "red";
        mensaje.textContent = "La justificación debe ser mas larga.";
        mensaje.style.display = "block";
        boton.disabled = true;
    } else {
        textarea.style.borderColor = "";
        mensaje.style.display = "none";
        boton.disabled = false;
    }
}

// ---------- Contraseña -----------
function comparar(id) {
    const pass = document.getElementById('pasper'+id);
    const pass1 = document.getElementById('newpasper'+id);
    const mensaje = document.getElementById('error-message'+id);
    const boton = document.getElementById('btncon'+id);
    
    if (pass.value !== pass1.value ) {
        pass1.style.borderColor = "red";
        mensaje.textContent = "Las contraseñas no coinciden.";
        mensaje.style.display = "block";
        boton.disabled = true;
        return;
    } else {
        pass1.style.borderColor = "";
        mensaje.style.display = "none";
        boton.disabled = false;
    }
}

function verpass(idinp, idbtn, id) {
    const passwordInput = document.getElementById(idinp+id);
    const eyeIcon = document.getElementById(idbtn+id);
  
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');  
    } else if (passwordInput.type === 'text'){
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
  }


window.onload = function() {
    validarHora("fecini");
    validarHora("fecfin");
    validarPermiso();
    actualizarMinMax(); // Asegurarse de que los límites min/max se actualicen al cargar
    actMinMax();
    contar();
    comparar();
};
