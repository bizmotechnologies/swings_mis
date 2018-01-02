/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// This script is used to save customers information -->

$(function () {
    $("#customerDetailsForm").submit(function () {
        dataString = $("#customerDetailsForm").serialize();
       //alert(dataString);

        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Manage_customers/save_CustomerDetails",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#msg_header").text('Message');
                $("#msg_span").css({'color': "black"});
                $("#addCustomers_err").html(data);
                $('#myModalnew').modal('show');
            }
        });
        return false;  //stop the actual form post !important!
    });
});

//- This script is used to save customers information -->
