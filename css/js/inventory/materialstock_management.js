var base_url = 'http://localhost/swings_mis/';
$(function () {
    $("#Add_material_form").submit(function () {
        dataString = $("#Add_material_form").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/Manage_materials/saveMaterial",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#addMaterial_err").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});

/* this function is used for show total material stocks quantity*/
function ShowMaterialStock() {

    dataString = 'Select_Materials_Id=' + $("#Select_Materials_Id").val();

    $.ajax({
        type: "POST",
        url: base_url + "inventory/MaterialStock_Management/ShowMaterialStock",
        data: dataString,
        cache: false,
        success: function (data) {

            $('#Input_MaterialStock').val(data);
        }
    });

}
/*this function is used for show total material stocks quantity*/

//----this fun is used to add raw material details information---------------------//
$(function () {
    $("#Manage_RawMaterialForm").submit(function () {
        dataString = $("#Manage_RawMaterialForm").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/MaterialStock_Management/Save_RawStockMaterial_Info",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#addProducts_err").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
//this fun is used to add raw material ends here----------------------------------//

//this fun is used to add purchased material Starts here----------------------------------//

$(function () {
    $("#Manage_PurchasedProductForm").submit(function () {
        dataString = $("#Manage_PurchasedProductForm").serialize();
        // alert(dataString);
        $.ajax({
            type: "POST",
            url: base_url + "inventory/MaterialStock_Management/Save_PurchasedProduct_Info",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                //alert(data);
                $("#addpurchaseproducts_err").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
//this fun is used to add Purchased material ends here----------------------------------//

//this fun is used to add raw material ends here----------------------------------//
//$(function () {
//    $("#Manage_FinishedProductForm").submit(function () {
//        dataString = $("#Manage_FinishedProductForm").serialize();
//        // alert(dataString);
//        $.ajax({
//            type: "POST",
//            url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/Save_FinishedProduct_Info",
//            data: dataString,
//            return: false, //stop the actual form post !important!
//            success: function (data)
//            {
//                //alert(data);
//                $("#addFinishedproducts_err").html(data);
//            }
//        });
//        return false;  //stop the actual form post !important!
//    });
//});

function Delete_material() {
    dataString = 'Select_NewMaterials_Id=' + $("#Select_NewMaterials_Id").val();
    $.ajax({
        type: "POST",
        url: base_url + "inventory/MaterialStock_Management/Delete",
        data: dataString,
        cache: false,
        success: function (data) {
            location.reload();
        }
    });

}