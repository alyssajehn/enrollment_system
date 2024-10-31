function navigateTo(formId) {
    const formsContainer = document.getElementById('forms');
    const allForms = document.querySelectorAll('.form-section');
    allForms.forEach(form => {
        form.style.display = 'none';
    });
    const selectedForm = document.getElementById(formId);
    if (selectedForm) {
        formsContainer.style.display = 'block';
        selectedForm.style.display = 'block';
        selectedForm.scrollIntoView({ behavior: 'smooth' });
    }
}
