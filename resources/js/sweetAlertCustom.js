window.Swal = require('sweetalert2');

let messageErrorDefault = "Não consegui atender vossa solicitação, tente novamente!";
let messageWarningDefault = "Ufaaa! Não apagamos nada.";
let timerDefault = 5000;

/**
 *
 * @param message {string}
 * @param type {string}
 * @param position {string}
 * @param timer {number}
 */
window.swallCustom = (message, type, position, timer = timerDefault) => {
    Swal.fire({
        position: position,
        type: type,
        title: message,
        showConfirmButton: true,
        timer: timer
    })
};


window.toastInfo = (message = messageWarningDefault, position = "top-end", timer = timerDefault) => {
	const messageInfo = Swal.mixin({
	    toast: true,
	    position: position,
	    showConfirmButton: true,
	    timer: timer,
	});

	messageInfo.fire({
	    type: "info",
	    title: message
	});
};

window.toastMessage = (message, type = "info", position = "top-end", timer = timerDefault) => {
	const swallMessage = Swal.mixin({
	    toast: true,
	    position: position,
	    showConfirmButton: true,
	    timer: timer,
	});

	swallMessage.fire({
	    type: type,
	    title: message
	});
};

window.toastSuccess = (message) => {
	const success = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: true,
	    timer: 1500,
	});

	success.fire({
	    type: 'success',
	    title: message
	});
};

window.toastError = (message = 'Não consegui atender vossa solicitação, tente novamente!', timer = timerDefault) => {
	const messageError = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: true,
	    timer: timer,
	});

	messageError.fire({
	    type: 'error',
	    title: message
	});
};

window.toastWarning = (message = messageWarningDefault) => {
	const warning = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: true,
	    timer: 1500,
	});

	warning.fire({
	    type: 'warning',
	    title: message
	});
};

window.alertErrorDatatable = (message = messageErrorDefault) => {
	const errorDatatable = Swal.mixin({
	    toast: true,
	    position: 'top-end',
	    showConfirmButton: true,
	    timer: 10000
	});

	errorDatatable.fire({
	    type: "error",
	    title: message
	});
};
