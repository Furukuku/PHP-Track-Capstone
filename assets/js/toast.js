const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    customClass: {
        popup: 'colored-toast',
    },
    showCloseButton: true,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    allowEscapeKey: true,
});