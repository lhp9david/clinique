console.log('view-list-patient.js loaded');
const patients = document.querySelectorAll('.patient_row');
const buttons = document.querySelectorAll('#btnConsultation');

buttons.forEach(button => {
    button.addEventListener('click', function () {

        let id = button.parentElement.parentElement.getAttribute('data-id');

        // Remove rotate(180deg) from buttons that weren't clicked
        buttons.forEach(btn => {
            if (btn.parentElement.parentElement.getAttribute('data-id') != id) {
                btn.removeAttribute('style');
            }
        });

        if (!button.getAttribute('style')) {
            button.style.transform = 'rotate(180deg)';
        }
        else {
            button.removeAttribute('style');
        }

        patients.forEach(element => {
            if (element.dataset.id != id) {

                if (!element.nextElementSibling.hasAttribute('hidden')) {
                    element.nextElementSibling.toggleAttribute('hidden');
                }
            }
            document.querySelector('.consultation' + id).toggleAttribute('hidden');
        });
    });
});

window.onload = function () {
    let patient = document.querySelectorAll('.patient_row');
    patient.forEach(element => {
        let id = element.getAttribute('data-id');
        if (id % 2 == 0) {
            element.style.backgroundColor = '#e9e4f1'
        }
    });
}