export function clearSearch(...elementIds) {
    elementIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.value = null;
        }
    });
}

export function showToast(message) {
    const toastLiveExample = document.getElementById('liveToast');
    if (toastLiveExample) {
        const toastBody = toastLiveExample.querySelector('.toast-content');
        if (toastBody) {
            toastBody.textContent = message;
        }
        const toastBootstrap = new bootstrap.Toast(toastLiveExample);
        toastBootstrap.show();
    }
}

export function updateStatus(previousValue, event, key) {
    event.preventDefault()
    const form = document.getElementById(`updateForm_${key}`);
    const spinner = document.getElementById(`spinner_${key}`);
    const selectElement = event.target;
    const formData = new FormData(form);
    form.classList.add("d-none");
    spinner.classList.remove("d-none");
    const toastLiveExample = document.getElementById('liveToast')
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if(response.ok) {
            form.classList.remove("d-none");
            spinner.classList.add("d-none");
        } else {
            form.classList.remove("d-none");
            spinner.classList.add("d-none");
            selectElement.value = previousValue
            showToast("An error occurred. Please try again.")
        }
    })
}

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll("#button-open-delete");
    const deleteForm = document.getElementById("deleteForm");
    let idToDelete;
    let rootToDelete;
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            idToDelete = this.getAttribute("data-id");
            rootToDelete = this.getAttribute("data-root");
        });
    });

    deleteForm.addEventListener("submit", function (event) {
        event.preventDefault();
        deleteForm.setAttribute("action", "/" + rootToDelete + "/" + idToDelete);
        deleteForm.submit();
    });
});