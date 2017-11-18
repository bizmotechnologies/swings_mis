/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var base_url = 'http://localhost/swings_mis/';

// This script is used to save customers information -->

$(function () {
    $("#customerDetailsForm").submit(function () {
        dataString = $("#customerDetailsForm").serialize();
                alert('njgn');

        $.ajax({
            type: "POST",
            url: base_url + "inventory/Manage_customers/save_CustomerDetails",
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
