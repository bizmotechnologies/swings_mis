    function Show_Enquiry() {

        enquiry_id = $('#enquiry_list [value="' + $('#enquiry_name').val() + '"]').data('value');
        $("#fetched_enquiryDetails").html('<center><img width="70%" height="auto" src="'+BASE_URL+'css/logos/page_spinner3.gif"/></center>');

        $.ajax({
            type: "POST",
            url: BASE_URL + "sales_enquiry/Manage_quotations/Show_Enquiry",
            data: {
                enquiry_id: enquiry_id
            },
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                //alert(data);
                $('#fetched_enquiryDetails').html(data);

            }
        });
    }


