/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*this script is used for submit fun to add vendor details*/
$(function () {
    $("#VendorDetailsForm").submit(function () {
        dataString = $("#VendorDetailsForm").serialize();
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Vendor_Management/save_VendorDetails",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#addVendorInformation_err").html(data);
            }
        });
        return false;  //stop the actual form post !important!
    });
});
/*this script is used for submit fun to add vendor details*/

