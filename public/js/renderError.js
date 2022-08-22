function renderError(errorArray, elementArray) {
    elementArray.map(value => {
        var element = document.getElementById(value);
        var elementError = document.getElementById(value + '-error');
        var spanError = `<span id="${value}-error" class="error invalid-feedback">${errorArray[value]}
        </span>`;
        if (elementError === null) {
            element.classList.add('is-invalid');
            element.insertAdjacentHTML('afterend', spanError);
        }else{
            elementError.remove();
            element.classList.add('is-invalid');
            element.insertAdjacentHTML('afterend', spanError);
        }

    });
}

function removeError(elementArray, formId = '') {
    if(formId !== '' ){
        var formData = document.getElementById(formId);
        elementArray.map(value => {
            var element = document.getElementById(value);
            var elementError = document.getElementById(value + '-error');
            element.classList.remove('is-invalid');
            if (elementError !== null) {
                elementError.remove();
            }
        });
        formData.reset();
    }
    
}