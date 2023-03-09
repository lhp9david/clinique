console.log('view-list-patient.js loaded');
const patients = document.querySelectorAll('.patient_row');

patients.forEach(patient => {
    patient.addEventListener('click', function () {
        patients.forEach(element => {
            let id = patient.getAttribute('data-id');
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