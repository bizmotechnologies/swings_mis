//$(function () {
//    $("#Manage_EnquiryForm").submit(function () {
//        dataString = $("#Manage_EnquiryForm").serialize();
//
//        $.ajax({
//            type: "POST",
//            url: BASE_URL + "inventory/Manage_materials/",
//            data: dataString,
//            return: false, //stop the actual form post !important!
//            success: function (data)
//            {
//                $("#msg_header").text('Message');
//                $("#msg_span").css({'color': "black"});
//                $("#addMaterials_err").html(data);
//                $('#myModalnew').modal('show');
//            }
//        });
//        return false;  //stop the actual form post !important!
//    });
//});
function GetMaterilaInformation() {
    Materialinfo = $('#Materialinfo [value="' + $('#Select_material_1').val() + '"]').data('value');
    //alert(Materialinfo);
    datas = {
        materialinfo: Materialinfo
    };
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/Manage_materials/GetMaterilaInformation",
        data: datas,
        cache: false,
        success: function (data) {
            alert(data);
            //$('#Show_producttable').html(data);
        }
    });
}

function GetMaterialInformation_ForEnquiry(fieldnum) {
    Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');
    Materialinfo = {
        Materialinfo: Materialinfo
    };
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/Manage_materials/GetMaterialInformation_ForEnquiry",
        data: Materialinfo,
        cache: false,
        success: function (data) {
            nota = JSON.parse(data);
            var ID = '';
            var OD = '';
            var Length = '';
            for (var i = 0; i < nota.length; i++) {

                ID += "<option data-value='" + nota[i].raw_ID + "' value='" + nota[i].raw_ID + "'>" + nota[i].raw_ID + "</option>";
                OD += "<option data-value='" + nota[i].raw_OD + "' value='" + nota[i].raw_OD + "'>" + nota[i].raw_OD + "</option>";
                Length += "<option data-value='" + nota[i].avail_length + "' value='" + nota[i].avail_length + "'>" + nota[i].avail_length + "</option>";
            }
            $("#MaterialID_" + fieldnum).empty();
            $("#MaterialID_" + fieldnum).append(ID);
            $("#MaterialOD_" + fieldnum).empty();
            $("#MaterialOD_" + fieldnum).append(OD);
            $("#MaterialLength_" + fieldnum).empty();
            $("#MaterialLength_" + fieldnum).append(Length);
        }
    });
}

$(document).ready(function () {
    var wrapper = $("#housing_statusforChecked_1");
    var x = 1;
    $('#checkHousing_1').on('change', function (e) {
        //e.preventDefault();
        if (this.checked) {
            x++;
            $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingChecked" name="profile_DescriptionForHousingChecked" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l3 s3"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingChecked" name="ID_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingChecked" name="OD_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingChecked" name="LENGTH_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>QUANTITY:</label><input type="number" placeholder="QUANTITY" class="form-control" style="text-transform:uppercase;" id="Set_QuantityforHousingChecked" name="Set_QuantityforHousingChecked" required></div></div></div>');

        } else {
            $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked" name="profile_DescriptionForHousingUnchecked" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l4 s4"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked" name="ID_forHousingUnckecked" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked" name="OD_forHousingUnckecked" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked" name="LENGTH_forHousingUnckecked" required></div></div></div>'); //add input box

        }
    });
});
$(document).ready(function () {
    var wrapper = $("#housing_statusforChecked_1");
var x = 1;
        if ($('#checkHousing_1').is(':checked')) {
        x++;
        $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingChecked" name="profile_DescriptionForHousingChecked" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l3 s3"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingChecked" name="ID_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingChecked" name="OD_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingChecked" name="LENGTH_forHousingChecked" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>QUANTITY:</label><input type="number" placeholder="QUANTITY" class="form-control" style="text-transform:uppercase;" id="Set_QuantityforHousingChecked" name="Set_QuantityforHousingChecked" required></div></div></div>');

    } else {
        $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked" name="profile_DescriptionForHousingUnchecked" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l4 s4"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked" name="ID_forHousingUnckecked" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked" name="OD_forHousingUnckecked" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked" name="LENGTH_forHousingUnckecked" required></div></div></div>'); //add input box

    }
});
function GetFinalPriceForMaterialCalculation(fieldnum) {
    //alert('hii');
    finalprice = '0';
    //quantity = '0';
    //discount = '0';
    quantity = $("#select_Quantity_" + fieldnum).val();
    discount = $("#discount_" + fieldnum).val();
    baseprice = $("#base_Price_" + fieldnum).val();
    if (discount === '' && quantity === '') {
        finalprice = baseprice;
    } else if (discount === '') {
        finalprice = (parseInt(baseprice) * parseInt(quantity));
    } else if (quantity === '') {
        finalprice = (parseInt(baseprice) - ((parseInt(discount) / 100) * (parseInt(baseprice))));
    } else if (discount !== '' && quantity !== '') {
        finalprice = ((parseInt(baseprice) * parseInt(quantity)) - ((parseInt(discount) / 100) * (parseInt(baseprice) * parseInt(quantity))));
    }

    $("#final_Price_" + fieldnum).val(finalprice);
}

function GetTubeHistoryForInquiry() {
    Customer_id = $('#Customers [value="' + $('#Select_Customers').val() + '"]').data('value');
    Profile_id = $('#Profiles [value="' + $('#Select_Profiles').val() + '"]').data('value');
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/Manage_materials/GetTubeHistoryForInquiry",
        data: {
            Customer_id: Customer_id,
            Profile_id: Profile_id
        },
        cache: false,
        success: function (data) {
            alert(data);
            //$('#Show_producttable').html(data);
        }
    });
}

function GetMaterialBasePrice(fieldnum) {
    Materialinfo = 0;
    MaterialID = 0;
    MaterialOD = 0;
    MaterialLength = 0;
    Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');
    MaterialID = $('#MaterialID_' + fieldnum + ' [value="' + $('#Select_ID_' + fieldnum).val() + '"]').data('value');
    MaterialOD = $('#MaterialOD_' + fieldnum + ' [value="' + $('#Select_OD_' + fieldnum).val() + '"]').data('value');
    MaterialLength = $('#MaterialLength_' + fieldnum + ' [value="' + $('#Select_Length_' + fieldnum).val() + '"]').data('value');
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/Manage_materials/GetMaterialBasePrice",
        data: {
            Materialinfo: Materialinfo,
            MaterialID: MaterialID,
            MaterialOD: MaterialOD,
            MaterialLength: MaterialLength
        },
        return: false, //stop the actual form post !important!
        success: function (data)
        {
            //                            $("#base_Price_" + fieldnum).empty();
            $('#base_Price_' + fieldnum).val(data);
        }
    });
}

