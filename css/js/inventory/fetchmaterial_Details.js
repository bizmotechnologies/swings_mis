$(function () {
    $("#Manage_EnquiryForm").submit(function () {
        dataString = $("#Manage_EnquiryForm").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Manage_materials/SaveProductsForEnquiry",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#msg_header").text('Message');
                $("#msg_span").css({'color': "black"});
                $("#addMaterials_err").html(data);
                $('#myModalnew').modal('show');
            }
        });
        return false;  //stop the actual form post !important!
    });
});


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

//function GetMaterialBasePrice(fieldnum) {
//    Materialinfo = 0;
//    MaterialLength = 0;
//    Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');
//    $("#Div_no_" + fieldnum + " input[name='Select_Length[]']").each(function ()
//    {
//        MaterialLength.push($(this).val());
//    });
//    bestTube = $('bestTube_' + fieldnum).val();
//
//    $.ajax({
//        type: "POST",
//        url: BASE_URL + "inventory/Manage_enquiry/GetMaterialBasePrice",
//        data: {
//            Materialinfo: Materialinfo,
//            MaterialLength: MaterialLength,
//            bestTube: bestTube 
//
//        },
//        return: false, //stop the actual form post !important!
//        success: function (data)
//        {
//            //                            $("#base_Price_" + fieldnum).empty();
//            $('#base_Price_' + fieldnum).val(data);
//        }
//    });
//}

