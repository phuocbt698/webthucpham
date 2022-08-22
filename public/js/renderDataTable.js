var element = '';

function renderData(elementId, url, columns){
    $('#' + elementId).DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "orderable": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "bDestroy": true,
        ajax: url,
        columns: columns
    });
    return element = elementId;
}