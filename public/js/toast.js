var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

function toastSuccess(type){
    switch (type) {
        case 'add':
            toastr.success('Dữ liệu đã được thêm mới thành công!')
            break;
        case 'edit':
            toastr.success('Dữ liệu đã được chỉnh sửa thành công!')
            break;
        case 'del':
            toastr.success('Dữ liệu được chọn đã được xóa thành công!')
            break;    
        default:
            break;
    }
}

function toastError(type){
    switch (type) {
        case 'add':
            toastr.error('Dữ liệu thêm mới thất bại! Vui lòng kiểm tra lại dữ liệu!')
            break;
        case 'edit':
            toastr.error('Dữ liệu chỉnh sửa thất bại! Vui lòng kiểm tra lại dữ liệu!')
            break;
        case 'del':
            toastr.error('Dữ liệu được chọn xóa thất bại! Vui lòng kiểm tra lại!')
            break;    
        default:
            break;
    }
}
$(function () {
   
    $('.swalDefaultSuccess').click(function () {
        Toast.fire({
            icon: 'success',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.swalDefaultInfo').click(function () {
        Toast.fire({
            icon: 'info',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.swalDefaultError').click(function () {
        Toast.fire({
            icon: 'error',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.swalDefaultWarning').click(function () {
        Toast.fire({
            icon: 'warning',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.swalDefaultQuestion').click(function () {
        Toast.fire({
            icon: 'question',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });

    $('.toastrDefaultSuccess').click(function () {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function () {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function () {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function () {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultTopLeft').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            position: 'topLeft',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultBottomRight').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            position: 'bottomRight',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultBottomLeft').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            position: 'bottomLeft',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultAutohide').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            autohide: true,
            delay: 750,
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultNotFixed').click(function () {
        $(document).Toasts('create', {
            title: 'Toast Title',
            fixed: false,
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultFull').click(function () {
        $(document).Toasts('create', {
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            icon: 'fas fa-envelope fa-lg',
        })
    });
    $('.toastsDefaultFullImage').click(function () {
        $(document).Toasts('create', {
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            image: '../../dist/img/user3-128x128.jpg',
            imageAlt: 'User Picture',
        })
    });
    $('.toastsDefaultSuccess').click(function () {
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultInfo').click(function () {
        $(document).Toasts('create', {
            class: 'bg-info',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultWarning').click(function () {
        $(document).Toasts('create', {
            class: 'bg-warning',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultDanger').click(function () {
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
    $('.toastsDefaultMaroon').click(function () {
        $(document).Toasts('create', {
            class: 'bg-maroon',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
});
