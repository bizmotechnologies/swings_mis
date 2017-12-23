/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// This script is used to save work order information -->

$(document).ready(function (e){
    $("#addWO_form").on('submit',(function(e){       
        e.preventDefault();        
        $.ajax({
            url: BASE_URL + "sales_enquiry/Manage_workorder/addWO",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                $.alert(data);
                location.reload();
                //$("#show_WOrecord").load(location.href + " #show_WOrecord>*", "");
            },
            error: function(){}             
        });
    }));
});
//- This script is used to save work order information -->




