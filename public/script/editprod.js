//script cho  ảnh chính sp hiển thị
function displaySingleImage(event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('single_image_preview');
    imagePreview.innerHTML = '';

    if (file) {
        const reader = new FileReader();
        const img = document.createElement('img');

        reader.onload = function(e) {
            img.src = e.target.result;
        }

        reader.readAsDataURL(file);
        img.style.maxWidth = '200px';
        img.style.height = 'auto';
        imagePreview.appendChild(img);
        document.getElementById('remove_image_button').style.display = 'block';
    }
}

function removeSingleImage() {
    document.getElementById('single_photo_input').value = '';
    document.getElementById('single_image_name').value = '';
    document.getElementById('single_image_preview').innerHTML = '';
    document.getElementById('remove_image_button').style.display = 'none';
}

document.getElementById('single_photo_input').addEventListener('change', function(event) {
    const file = event.target.files[0];
    document.getElementById('single_image_name').value = file.name;
});
//script cho nhiều ảnh hiển thị


function displayMultipleImages(event) {
    const files = event.target.files;
    const imagePreview = document.getElementById('imagePreview');
    imagePreview.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        const img = document.createElement('img');
        const imageContainer = document.createElement('div');
        const deleteBtn = document.createElement('button');
        deleteBtn.innerHTML = 'x';
        deleteBtn.className = 'delete-button';
        deleteBtn.addEventListener('click', function() {
            // Xóa ảnh khi người dùng nhấn nút xóa
            imagePreview.removeChild(imageContainer);
            // Cập nhật lại tên các ảnh đã chọn
            updateImageNames();
        });

        reader.onload = function(e) {
            img.src = e.target.result;
        }

        reader.readAsDataURL(files[i]);
        img.style.width = '110px';
        img.style.height = '80px';
        img.style.marginBottom = '5px';
        imageContainer.className = 'image-container';
        imageContainer.appendChild(img);
        imageContainer.appendChild(deleteBtn);
        imagePreview.appendChild(imageContainer);
    }
    
    // Cập nhật lại tên các ảnh đã chọn
    updateImageNames();
}

function updateImageNames() {
    const imagePreview = document.getElementById('imagePreview');
    const imageContainers = imagePreview.querySelectorAll('.image-container');
    let fileNames = '';

    imageContainers.forEach(function(imageContainer) {
        const img = imageContainer.querySelector('img');
        fileNames += img.src.substring(img.src.lastIndexOf('/') + 1) + ', ';
    });

    fileNames = fileNames.slice(0, -2); // Remove the last comma and space
    document.getElementById('multiple_images_name').value = fileNames;
}

document.getElementById('multiple_photos_input').addEventListener('change', function(event) {
    const files = event.target.files;
    let fileNames = '';
    for (let i = 0; i < files.length; i++) {
        fileNames += files[i].name + ', ';
    }
    fileNames = fileNames.slice(0, -2); // Remove the last comma and space
    document.getElementById('multiple_images_name').value = fileNames;
});
// new
// function displaySingleImage(event) {
//     var input = event.target;
//     var img = document.getElementById('new-image-preview');
//     img.src = URL.createObjectURL(input.files[0]);
//     img.style.display = 'block';
// }
// function displaySingleImage(event) {
//     // Lấy element input chứa file ảnh
//     var input = event.target;
//     // Lấy element img để hiển thị ảnh
//     var img = document.getElementById('single_product_image');
//     // Cập nhật nguồn ảnh của img khi người dùng chọn tệp mới
//     img.src = URL.createObjectURL(input.files[0]);
// }
