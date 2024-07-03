
function displayImages(event) {
    var files = event.target.files;
    var photoPreviews = document.getElementById('photoPreviews');
    var fileInput = document.getElementById('photos');

    // Clear the photoPreviews container before adding new images
    photoPreviews.innerHTML = '';

    for (var i = 0; i < files.length; i++) {
        (function(index) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');
                
                var image = document.createElement('img');
                var deleteButton = document.createElement('button');

                var fileName = files[index].name; // Save the file name

                image.src = e.target.result;
                image.style.maxWidth = '120px';
                image.style.maxHeight = '120px';

                deleteButton.innerText = 'Xóa';
                deleteButton.classList.add('delete-button');
                deleteButton.onclick = function() {
                    // Remove the image from the UI
                    imageContainer.parentNode.removeChild(imageContainer);
                    // Remove the image from the file input
                    var newFiles = Array.from(fileInput.files);
                    newFiles.splice(index, 1);
                    var newFileList = new DataTransfer();
                    newFiles.forEach(function(file) {
                        if (file.name !== fileName) { // Check file name before adding to the list
                            newFileList.items.add(file);
                        }
                    });
                    fileInput.files = newFileList.files;
                };

                imageContainer.appendChild(image);
                imageContainer.appendChild(deleteButton);
                photoPreviews.appendChild(imageContainer);
            };
            reader.readAsDataURL(files[index]);
        })(i);
    }
}



                        
                        function displayImage(event) {
                            var reader = new FileReader();
                            
                            reader.onload = function(){
                                var image = document.getElementById('photoPreview');
                                image.src = reader.result;
                                image.style.display = 'block';
                            }
                            
                            reader.readAsDataURL(event.target.files[0]);
                        }
                  