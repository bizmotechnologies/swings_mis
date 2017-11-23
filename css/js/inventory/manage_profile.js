/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// This script is used to save profile information -->

$(document).ready(function (e){
    $("#addProfile_form").on('submit',(function(e){       
        e.preventDefault();        
        $.ajax({
            url: BASE_URL + "inventory/Manage_profiles/addProfile",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                $.alert(data);
            },
            error: function(){}             
        });
    }));
});
//- This script is used to save profile information -->


// ----function to preview selected image for profile------//
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_imagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(function () {
    $("#profile_image").change(function(){
        readURL(this);
    });
});
// ------------function preview image end------------------//


