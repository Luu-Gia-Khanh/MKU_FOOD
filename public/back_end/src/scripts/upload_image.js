function uploadhinh() {
    var input = document.getElementById('file_upload');
    var url = URL.createObjectURL(input.files[0]);
    image_upload.setAttribute('src', url);
}
