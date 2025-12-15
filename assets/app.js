document.addEventListener("DOMContentLoaded", () => {

    const addPatientModal = document.getElementById('addPatientModal');
    const showAddPatientBtn = document.getElementById('showAddPatientForm');
    const cancelAddBtn = document.getElementById('cancel_add');

    if (showAddPatientBtn) {
        showAddPatientBtn.addEventListener('click', function() {
            addPatientModal.classList.remove('hidden');
        });
    }

    if (cancelAddBtn) {
        cancelAddBtn.addEventListener('click', function() {
            addPatientModal.classList.add('hidden');
        });
    }




















});
