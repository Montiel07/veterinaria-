document.addEventListener('DOMContentLoaded', function () {
    const rolSelect = document.getElementById('rol');
    const vetFields = document.getElementById('veterinario_fields');

    if (rolSelect && vetFields) {
        function toggleVetFields() {
            if (rolSelect.value === 'veterinario') {
                vetFields.style.display = 'block';
            } else {
                vetFields.style.display = 'none';
            }
        }

        rolSelect.addEventListener('change', toggleVetFields);
    }
});
