var imagesDeleted = [];
var imagesProduct = null;

function imagesProducts(images){
    imagesProduct = images;

    images.forEach(element => {
        document.getElementById(`image-${element['id']}`).addEventListener('click', () => {
            document.getElementById('con__currently__images').removeChild(document.getElementById(`con-image-${element['id']}`))
            imagesDeleted.push({
                id: element['id'],
            })

            if(imagesProduct.length == imagesDeleted.length){
                $('#text-img').empty();
                document.getElementById('text-img').appendChild(document.createTextNode('Se han elimnado todas las imágenes registradas'))
            }
        })

    });
}
function savePictures(){
    imagesDeleted.forEach(element => {
        let input = document.createElement('input');
        input.setAttribute('name', 'deletedPhotos[]');
        input.value = element['id'];
        input.style.display = 'none';
        document.getElementById('form__edit__product').appendChild(input);
    });
    imagesProduct.forEach( element=> {
        let input = document.createElement('input');
        input.value = element['id'];
        input.setAttribute('name', 'imagesProduct[]');
        input.style.display = 'none';
        document.getElementById('form__edit__product').appendChild(input);
    });
    tinyMCE.triggerSave();
}
