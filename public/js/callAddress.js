function getAddress(eleCity, eleDistrict, eleWard) {
    fetch('https://provinces.open-api.vn/api/?depth=3')
        .then((response) => response.json())
        .then((data) =>{
            var districts;
            data.map(value => {
                $('#' + eleCity).append(`<option value="${value.code}">${value.name}</option>`);
            });
            $('#' + eleCity).change(function(){
                $('#' + eleDistrict).html('<option>Chọn quận/huyện</option>');
                $('#' + eleWard).html('<option> Chọn phường/xã </option>');
                let idCity = $(this).val();
                data.map(value => {
                    if(value.code == idCity){
                        districts = value.districts;
                        districts.map(value => {
                            $('#' + eleDistrict).append(`<option value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            });
            $('#' + eleDistrict).change(function(){
                $('#' + eleWard).html('<option> Chọn phường/xã </option>');
                let idDistrict = $(this).val();
                districts.map(value => {
                    if(value.code == idDistrict){
                        ward = value.wards;
                        ward.map(value => {
                            $('#' + eleWard).append(`<option value="${value.code}">${value.name}</option>`);
                        });
                    }
                })
            })
        });
}

function getAddressFileJson(eleCity, eleDistrict, eleWard){
    dataAddress = JSON.parse(data);
    var districts;
    dataAddress.map(value => {
        $('#' + eleCity).append(`<option value="${value.code}">${value.name}</option>`);
    });
    $('#' + eleCity).change(function(){
        $('#' + eleDistrict).html('<option>Chọn quận/huyện</option>');
        $('#' + eleWard).html('<option> Chọn phường/xã </option>');
        let idCity = $(this).val();
        dataAddress.map(value => {
            if(value.code == idCity){
                districts = value.districts;
                districts.map(value => {
                    $('#' + eleDistrict).append(`<option value="${value.code}">${value.name}</option>`);
                });
            }
        })
    });
    $('#' + eleDistrict).change(function(){
        $('#' + eleWard).html('<option> Chọn phường/xã </option>');
        let idDistrict = $(this).val();
        districts.map(value => {
            if(value.code == idDistrict){
                let ward = value.wards;
                ward.map(value => {
                    $('#' + eleWard).append(`<option value="${value.code}">${value.name}</option>`);
                });
            }
        })
    })
}