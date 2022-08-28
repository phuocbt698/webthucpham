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
        return resultArr.success;
    } else {
        toastError(type);
        return resultArr.errors;
    }
}

function deleteAjax(url) {
    var confirm = window.confirm('Bạn có muốn xóa dòng dữ liệu này! Sau khi xóa dữ liệu không thể khôi phục lại! Cẩn thận!');
    if (confirm) {
        if (confirm) {
            var ajax = $.ajax({
                url: url,
                data: { _method: 'delete' },
                method: 'delete',
                typeData: 'json',
                async: false
            });
            var status = (ajax.responseJSON).statusCode;
            if(ajax.status == 500){
                toastMessageDanger('Trường đang xóa liên quan đến các dữ liệu khác trong DB!');      
            }else{
                switch (status) {
                    case 200:
                        $('#' + element).DataTable().clear().draw(true);
                        toastSuccess('del');
                        break;
                    case 400:
                        toastError('del');
                        break;
                    case 405:
                        toastMessageDanger('Bạn không có quyền để thực hiện chức năng này!');
                        break;
                    case 423:
                        toastMessageDanger('Bạn không thể xóa chính bản thân mình!');
                        break;
                }
            }
            
        }
    }
}

function deleteManyAjax(url) {
    var checked = $("input:checkbox[name=deleteMany]:checked");
    if (checked.length != 0) {
        var confirm = window.confirm('Bạn có muốn xóa dòng dữ liệu này! Sau khi xóa dữ liệu không thể khôi phục lại! Cẩn thận!');
        if (confirm) {
            var arrID = [];
            $("input:checkbox[name=deleteMany]:checked").each(function () {
                arrID.push($(this).val());
            });
            var ajax = $.ajax({
                url: url,
                data: { arrID, _method: 'delete' },
                method: 'delete',
                typeData: 'json',
                async: false
            });
            var status = (ajax.responseJSON).statusCode;
            if(ajax.status == 500){
                toastMessageDanger('Có trường đang xóa liên quan đến các dữ liệu khác trong DB!');      
            }else{
                switch (status) {
                    case 200:
                        $('#' + element).DataTable().clear().draw(true);
                        toastSuccess('del');
                        break;
                    case 400:
                        toastError('del');
                        break;
                    case 405:
                        toastMessageDanger('Bạn không có quyền để thực hiện chức năng này!');
                        break;
                    case 423:
                        toastMessageDanger('Bạn không thể xóa chính bản thân mình!');
                        break;
                }
            }
            
        }
    } else {
        return false;
    }

}