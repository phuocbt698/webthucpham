function previewImage(e, idPreviewTag, user = true) {
    const preview = document.getElementById(idPreviewTag);
    const imageOld = document.getElementById('preview-image')
    const files = e.target.files;
    const file = files[0];
    const fileReader = new FileReader();
    if (imageOld) {
        $('#preview-image').remove();
        fileReader.readAsDataURL(file);
        fileReader.onload = function () {
            const src = fileReader.result;
            if(user){
                var tagImage = `<img src="${src}" alt="${file.name}" class="w-50 rounded-circle  img-thumbnail preview-img" id = 'preview-image' />`  
            }else{
                var tagImage = `<img src="${src}" alt="${file.name}" class="w-50 img-thumbnail preview-img" id = 'preview-image' />`
            }
            preview.insertAdjacentHTML('beforeend', tagImage)
        }
    } else {
        fileReader.readAsDataURL(file);
        fileReader.onload = function () {
            const src = fileReader.result;
            if(user){
                var tagImage = `<img src="${src}" alt="${file.name}" class="w-50 rounded-circle  img-thumbnail preview-img" id = 'preview-image' />`  
            }else{
                var tagImage = `<img src="${src}" alt="${file.name}" class="w-50 img-thumbnail preview-img" id = 'preview-image' />`
            }
            preview.insertAdjacentHTML('beforeend', tagImage)
        }
    }
}

function preview(eleFile, preview, user = true){
    $('#' + eleFile).change(function(e) {
        const label = `<label for="imageNew" id='imageNew'>Image New</label>`;
        var labelID = document.getElementById('imageNew');
        if(labelID){
            previewImage(e, preview, user);
        }else{
            document.getElementById('preview').insertAdjacentHTML('beforeend', label);
            previewImage(e, preview, user);
        }
    })
}