$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function sendAjax(url, data, type, method = 'POST') {
    var result = $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
        async: false,
        typeData: 'json'
    });
    return resultAjax(result, type);
}

function resultAjax(result, type) {
    var resultArr = JSON.parse(result.responseText);
    if (typeof resultArr.errors === 'undefined') {
        toastSuccess(type);
    } else {
        toastError(type);
        return resultArr.errors;
    }
}

function deleteAjax(url) {
    var confirm = window.confirm('Bạn có muốn xóa dòng dữ liệu này! Sau khi xóa dữ liệu không thể khôi phục lại! Cẩn thận!');
    if (confirm) {
        var ajax = sendAjax(url, '', 'del', 'delete');
        if (!ajax) {
            $('#' + element).DataTable().clear().draw(true);
        }
    }
}

function deleteManyAjax(url) {
    var confirm = window.confirm('Bạn có muốn xóa dòng dữ liệu này! Sau khi xóa dữ liệu không thể khôi phục lại! Cẩn thận!');
    if (confirm) {
        var arrID = [];
        $("input:checkbox[name=deleteMany]:checked").each(function () {
            arrID.push($(this).val());
        });
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'json',
            data: { arrID, _method: 'delete' },
            success: function(){
                toastSuccess('del');
                $('#' + element).DataTable().clear().draw(true);
            },
            error: function(){
                toastError('del');
            }
        });
    }
}