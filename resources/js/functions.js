import Swal from "sweetalert2";

function showSuccessMessage(title, message, onclose, btn = true) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'success',
        showConfirmButton: btn,
        didClose: onclose
    });
}

function uploadImage(albumId) {
    Swal.fire({
        title: 'Bilder upload',
        html: `
                <form id="media-upload-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="media">Wähle deine Bilder aus</label>
                        <input type="file" multiple name="media[]" id="media" class="form-control" accept="image/*,video/*" required>
                    </div>
                </form>
            `,
        showCancelButton: true,
        confirmButtonText: 'Upload',
        preConfirm: () => {
            const form = document.getElementById('media-upload-form');
            const formData = new FormData(form);

            return fetch('/album/' + albumId + '/media/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.message || 'Error uploading media');
                    }
                    return data;
                }).catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    );
                });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Super!',
                text: 'Erfolgreich hochgeladen.',
                icon: 'success'
            }).then(() => {
                window.location.reload();
            });
        }
    });
}

function copyUrl(url) {
    // Create a temporary input element
    const tempInput = document.createElement('input');
    tempInput.value = url;
    document.body.appendChild(tempInput);

    // Select the input value
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the input
    document.execCommand('copy');

    // Remove the temporary input element
    document.body.removeChild(tempInput);

    // Optionally, you can show a message to the user
    showSuccessMessage('Kopiert', 'Der Link wurde kopiert :)', null, true);
}


window.showSuccessMessage = showSuccessMessage;
window.uploadImage = uploadImage;
window.copyUrl = copyUrl;
