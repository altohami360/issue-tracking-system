import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jquery from 'jquery';

window.$ = jquery;

import Swal from 'sweetalert2'

window.Swal = Swal;

window.deleteConfirm = function(formId) {
    Swal.fire({
        icon: 'warning',
        text: 'Do you want to delete this?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.success = function () {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been success',
        showConfirmButton: false,
        timer: 2000
    })
}

