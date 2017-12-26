<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raise Enquiry</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
    <link href="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">

    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/fetchmaterial_Details.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/sales/manage_enquiries.js"></script>
    <script src="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.js"></script>

    <script>
        var currparent = 1;
        var currchild = 1;
        function getChildDivHtml(id) {// this code is used for add div to parent div on click fun
            return '<div class="w3-card-2 w3-margin w3-round-xlarge w3-col l12 w3-padding">\n\
            <a href="#" class="btn delete w3-text-grey w3-margin-right w3-right" title="Remove product">remove <i class="fa fa-remove"></i></a>\n\
            <div class="w3-col l12 " id="Product_' + currparent + '">\n\
            <div class="w3-col l12 w3-padding-left"><label class="w3-round w3-medium w3-label w3-black w3-padding">Product ' + currparent + '</label>\n\
            </div>\n\
            <div class="w3-col l12 w3-padding w3-small">\n\
            \n\
            <div class="w3-col l3 w3-left">\n\
            <div class="input-group">\n\
            <label>Product Name:</label>\n\
            <input type="text" onclick="this.select();" placeholder="Product Name" value="" class="w3-input" style="text-transform:uppercase;" id="product_nameForEnquiry_' + currparent + '" name="product_nameForEnquiry[]" >\n\
            </div>\n\
            </div>\n\
            \n\
            </div>\n\
            \n\<div class="w3-col l12 w3-padding w3-small">\n\
            <hr>\n\
            <div class="w3-col l3 w3-left">\n\
            <div class="input-group">\n\
            <label>Profile:</label>\n\
            <input list="Profiles_' + currparent + '" onclick="this.select();" id="Select_Profiles_' + currparent + '" name="Select_Profiles[]" value="<?php echo $div['profile_id']; ?>" class="w3-input" required type="text" placeholder="Select Profile Name" onchange="GetProfileInformation(' + currparent + ');"><input name="profile_id[]" id="profile_id_fetch_' + currparent + '" type="hidden">\n\
            <datalist id="Profiles_' + currparent + '">\n\
            <?php foreach ($profileinfo['status_message'] as $result) { ?><option data-value="<?php echo $result['profile_id']; ?>" value="<?php echo $result['profile_name']; ?>"></option><?php } ?></datalist>\n\
            </div>\n\
            </div>\n\<div class="w3-col l5 w3-center w3-padding w3-small" id="profile_image_div_' + currparent + '"></div>\n\
            </div>\n\
            \n\
            <div class="w3-col l12 w3-light-grey w3-padding w3-small">\n\
            \n\
            <div class="w3-col l10 w3-left">\n\
            <div class="input-group ">\n\
            <input type="checkbox" name = "checkHousing[]" id="checkHousing_' + currparent + '" onchange="GetHousingValue(' + currparent + ');" value="1"><b>  Housing Available</b>\n\
            </div>\n\
            </div>\n\
            </div>\n\
            \n\
            <div class="w3-light-grey" id="housing_statusforChecked_' + currparent + '">\n\
            \n\<div class="w3-col l12" style="display: none;" id="Housing_Div_' + currparent + '">\n\
            <div class="w3-col l12 w3-padding w3-small">\n\
            <div class="w3-col l6">\n\
            <label>Profile Description:</label>\n\
            <input type="text" value="" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="w3-input" style="text-transform:uppercase;" onclick="this.select();" id="profile_DescriptionForHousingUnchecked_' + currparent + '" name="profile_DescriptionForHousingUnchecked[]" >\n\
            </div>\n\
            </div>\n\
            <div class="w3-col l12 w3-padding w3-small">\n\
            \n\
            <div class="w3-col l4 s4">\n\
            <div class="input-group">\n\
            <label>ID:</label>\n\
            <input type="number" placeholder="ID" onclick="this.select();" min="0" class="w3-input" value="" style="text-transform:uppercase;" id="ID_forHousingUnckecked_' + currparent + '" name="ID_forHousingUnckecked[]" >\n\
            </div>\n\
            </div>\n\
            \n\
            <div class="w3-col l4 s4 w3-padding-left">\n\
            <div class="input-group">\n\
            <label>OD:</label>\n\
            <input type="number" placeholder="OD" onclick="this.select();" min="0" class="w3-input" value="" style="text-transform:uppercase;" id="OD_forHousingUnckecked_' + currparent + '" name="OD_forHousingUnckecked[]" >\n\
            </div>\n\
            </div>\n\
            \n\
            <div class="w3-col l4 s4 w3-padding-left">\n\
            <div class="input-group">\n\
            <label>LENGTH:</label>\n\
            <input type="number" onclick="this.select();" placeholder="LENGTH" min="0" class="w3-input" value="" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_' + currparent + '" name="LENGTH_forHousingUnckecked[]" >\n\
            </div>\n\
            </div>\n\
            \n\
            </div>\n\
            \n\
            \n\</div>\n\
            \n\
            </div>\n\
            \n\<div class="w3-col l12 w3-padding-left w3-margin-top w3-margin-bottom w3-light-grey" id="MaterialDiv_' + currparent + '">\n\
            </div>\n\
            </div>\n\
            <div class="w3-col l12 w3-margin-top w3-margin-bottom w3-small">\n\
            <div class="w3-col l4 w3-padding-left">\n\
            <label>QUANTITY</label>\n\
            <input value="1" id="Product_Quantity_' + currparent + '" onclick="this.select();" name="Product_Quantity[]" value="<?php echo $div['product_quantity']; ?>" class="w3-input" required type="number" min="0" placeholder="Product Quantity" onkeyup="GetProductfinalPrice(' + currparent + ');">\n\
            </div>\n\
            <div class="w3-col l4 w3-padding-left">\n\
            <label>Product Discount</label>\n\
            <input id="Product_Discount_' + currparent + '" onclick="this.select();" name="Product_Discount[]" value="" class="w3-input" required type="number" value="0" min="0" step="0.01" placeholder="Product discount" onkeyup="GetProductfinalPrice(' + currparent + ');">\n\
            </div>\n\
            <div class="w3-col l4 w3-padding-left">\n\
            <label>Total Product Price</label>\n\
            <input id="TotalProduct_Price_' + currparent + '" name="TotalProduct_Price[]" value="<?php echo $div['product_price']; ?>" class="w3-input" required type="number" min="0" step="0.01" placeholder="Net Product Price" onfocus="GetProductfinalPrice(' + currparent + ');">\n\
            </div>\n\
</div></div>'; // this code is used for add div to parent div on click fun
}
        $(document).ready(function () {// this fun is used for add above code to parent div on click fun
            $('#btn-add-product').on('click', function () {
                $('div#parent').append(getChildDivHtml(currparent));
                currparent++;
        }); // this fun is used for add above code to parent div on click fun


        $('div#parent').on("click", ".delete", function (e) {// this fun is used for remove materials from parent div on click fun
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        }); // this fun is used for remove materials from parent div on click fun
    });
</script>
<script>
        function GetHousingValue(currentparent) {// this fun is used for show housing div on checkbox of housing
            var wrapper = $("#housing_statusforChecked_" + currentparent);
            var x = 1;
            var check_status = document.getElementById("checkHousing_" + currentparent).checked;
            if (check_status) {
                x++;
        $('#Housing_Div_'+currentparent).css('display', 'block');  // this fun is used for show housing div on checkbox of housing check
    } else {
        $('#Housing_Div_'+currentparent).css('display', 'none'); // this fun is used for show housing div on checkbox of housing uncheck
    }
}
</script>
<script>
        function GetProductPrice(rownum) { //----------------this fun is used to get product price---------------
            AvailablePrice = 0;
            final_Price = 0;
            Product_Quantity = 0;
            var final_Price = [];
            var Product_Quantity = [];
            var AvailablePrice = [];
            AvailablePricesum = 0;
            FinalPricesum = 0;
            ProductQuantity = 0;
            productPrice = 0;
            $('#Product_' + rownum + ' input[name="final_Price[]"]').each(function ()
            {
               if($(this).val() ){
                final_Price.push($(this).val());
            }
        });
            $('#Product_' + rownum + ' input[name="Available_Price[]"]').each(function ()
            {
               if($(this).val() ){
                AvailablePrice.push($(this).val());
            }
        });
            ProductQuantity = document.getElementById('Product_Quantity_' + rownum).value;

        //-----this loop is used to addition of the final price of material------//
        FinalPrice = final_Price.length;
        while (FinalPrice--) {
            FinalPricesum += parseFloat(final_Price[FinalPrice]) || 0;
        }
        //-----this loop ends here for used to addition of the final price of material------//
        
        //-----this loop is used to addition of the base price of material------//
        AvailablePricenew = AvailablePrice.length;
        while (AvailablePricenew--) {
            AvailablePricesum += parseFloat(AvailablePrice[AvailablePricenew]) || 0;
        }
        //-----this loop ends here for used to addition of the base price of material------//
        
        temporary_amount = AvailablePricesum - FinalPricesum;  //------this amount is used for get calculate price for discount
        //alert(temporary_amount);
        Discount = temporary_amount / AvailablePricesum * 100; //-----finding the discount here by deviding 
        
        $('#Product_Discount_' + rownum).val(Discount.toFixed(2));   //------discount value set to the text field 
        
        productPrice = (FinalPricesum * parseInt(ProductQuantity));  //-----product price multiplied with quantity
        
        DiscountPrice = productPrice * Discount / 100;
        
        productFinalprice = AvailablePricesum - DiscountPrice;
        //alert(productPrice);
        $('#TotalProduct_Price_' + rownum).val(productFinalprice.toFixed(2));
    }
        //----------------------this fun is used to get product price---------------------------
    </script>  
    <script>
        function GetProductfinalPrice(rownum){

         final_Price = 0;
         var final_Price = [];
         FinalPricesum = 0;
         TotalProduct_Price = $('#TotalProduct_Price_' + rownum).val();
         ProductQuantity = $('#Product_Quantity_' + rownum).val();
         productDiscount = $('#Product_Discount_' + rownum).val();   //------discount value set to the text field 
           
            $('#Product_' + rownum + ' input[name="final_Price[]"]').each(function ()  //get material final price array
            {
               if($(this).val() ){
                final_Price.push($(this).val());
            }
        });

            FinalPrice = final_Price.length;
            while (FinalPrice--) {
        FinalPricesum += parseFloat(final_Price[FinalPrice]) || 0;  //--final price array sum
    }
    //alert(FinalPricesum);
    price = (ProductQuantity) * FinalPricesum; //---price multiplied by quantity
    finalProductPrice = price * productDiscount / 100; //---discount on final price
    productPrice = price - finalProductPrice;  //-----total price
    $('#TotalProduct_Price_' + rownum).val(productPrice.toFixed(2));
}
</script>
<script>
        function GetProfileInformation(rownum) {//this fun is used for get profile information
            Profiles = $('#Profiles_' + rownum + ' [value="' + $('#Select_Profiles_' + rownum).val() + '"]').data('value');
            $('#profile_id_fetch_' + rownum).val(Profiles);
            Customer = $('#Customers [value="' + $('#Customers').val() + '"]').data('value');

            $("#MaterialDiv_" + rownum).html('<center><img width="auto" height="auto" src="'+BASE_URL+'css/logos/page_spinner3.gif"/></center>');
            Get_housingData(Profiles,rownum);       //------------profile history data
            getprofileimage(Profiles, rownum);      //------------profile image data 
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>inventory/Manage_materials/GetProfileInformation",
                data: {
                    Profiles: Profiles,
                    Profile_num: rownum
                },
                cache: false,
                success: function (data) {
                //alert(data);
                $('#MaterialDiv_' + rownum).html(data);
                $('#Housing_Div').css('display', 'block');                            // this fun is used for show housing div on checkbox of housing
            }
        });
        }//this fun is used for get profile information

        function getprofileimage(Profiles, rownum) {//this fun is used for show profile image
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>inventory/Manage_materials/getprofileimage",
                data: {
                    Profiles: Profiles
                },
                cache: false,
                success: function (data) {
                //alert(data);
                $('#profile_image_div_' + rownum).html('<center><img width="30%" alt="Profile image not found" class="img img-thumbnail" height="30%" onerror="this.src=\''+ BASE_URL +'images/default_image.png\'" src="' + BASE_URL + '' + data + '"/></center>');
            }
        });
        }
        function Get_housingData(Profiles,rownum){//-------------this fun is used to set populated housing values on profile change
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>inventory/Manage_materials/Get_housingData",
                data: {
                    Profiles: Profiles
                },
                cache: false,
                success: function (data) {
                //alert(data);
                key = JSON.parse(data);
                
                for(var i=0;i<key.length;i++){
                    //alert(key[i].housing_status);
                    if(key[i].housing_status == 1){
                      $('#checkHousing_'+rownum).prop('checked', true);
                  $('#Housing_Div_'+rownum).css('display', 'block');                            // this fun is used for show housing div on checkbox of housing
                  $('#profile_DescriptionForHousingUnchecked_'+rownum).val(key[i].profile_description);
                  $('#ID_forHousingUnckecked_'+rownum).val(key[i].Prod_ID);
                  $('#OD_forHousingUnckecked_'+rownum).val(key[i].Prod_OD);
                  $('#LENGTH_forHousingUnckecked_'+rownum).val(key[i].Prod_length);
                  //$('#Product_Quantity_'+rownum).val(key[i].product_quantity);
              }else{
                  $('#checkHousing_'+rownum).prop('checked', false);
                  $('#Housing_Div_'+rownum).css('display', 'none');                            // this fun is used for show housing div on checkbox of housing
                  $('#profile_DescriptionForHousingUnchecked_'+rownum).val(key[i].profile_description);
                  $('#ID_forHousingUnckecked_'+rownum).val(key[i].Prod_ID);
                  $('#OD_forHousingUnckecked_'+rownum).val(key[i].Prod_OD);
                  $('#LENGTH_forHousingUnckecked_'+rownum).val(key[i].Prod_length);  
              }                        
          }   
      }

  });
        }//-------------this fun is used to set populated housing values on profile change
    </script>
    <script>
        function get_AvailableTube(fieldnum, countnum) { //this fun is used to get available tube for product material---------
            Materialinfo = 0;
            MaterialID = 0;
            MaterialOD = 0;
            Materialinfo = $('#Materialinfo_' + fieldnum + '_' + countnum + ' [value="' + $('#Select_material_' + fieldnum + '_' + countnum).val() + '"]').data('value');
            var MaterialID = [];
            var MaterialOD = [];
            $('#Div_no_' + fieldnum + '_' + countnum + ' input[name="Select_ID[' + fieldnum + '][]"]').each(function ()
            {
               if($(this).val() ){
                MaterialID.push($(this).val());
            }
        });
            $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_OD[" + fieldnum + "][]']").each(function ()
            {
               if($(this).val() ){
                MaterialOD.push($(this).val());
            }
        });
        //alert(Materialinfo);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>inventory/Manage_enquiry/get_AvailableTube",
            data: {
                Materialinfo: Materialinfo,
                MaterialID: MaterialID,
                MaterialOD: MaterialOD
            },
            cache: false,
            success: function (data) {
                //alert(data);
                $('#available_tube_' + fieldnum + '_' + countnum).html(data);
            }
        }); //this fun is used to get available tube for product material---------//
    }

</script>
</head>
<body class="w3-light-grey">
    <div class="w3-main" style="margin-left:120px;">
        <!-- Header -->

        <header class="w3-container" >
            <h5><b><i class="fa fa-cubes"></i> Manage Enquiry</b></h5>
        </header>
        <div class="w3-col l12 w3-padding-left">
            <div class="w3-col l12 w3-padding-left w3-small">
                <label>Add New Enquiry</label>
            </div>

        </div>
        <form method="POST" action="<?php echo base_url(); ?>inventory/Manage_materials/SaveProductsForEnquiry" id="Manage_EnquiryForm" name="Manage_EnquiryForm">
            <div class="w3-col l12" id="parent"><!--this div for customer for to quotation-->
                <div class="w3-col l12 w3-padding w3-small">
                    <div class="w3-col l2 w3-padding-left">
                        <label>Customer Name:</label> 
                        <input list="Customers" id="Select_Customers" autocomplete="off" onclick="this.select();" name="Select_Customers" value="<?php echo $cust_name; ?>" class="w3-input" required type="text" placeholder="Select Customer" onchange="getCustomerId()">  
                        <input type="hidden" name="customer_id" id="customer_id">                                      
                        <datalist id="Customers">
                            <?php foreach ($customers['status_message'] as $result) { ?>
                            <option data-value="<?php echo $result['cust_id']; ?>" value='<?php echo $result['customer_name']; ?>'></option>
                            <?php } ?>
                        </datalist>
                    </div>
                    <div class="w3-col l2 w3-left">
                     <div class="w3-col l12">
                        <label class="w3-text-white">Customer Name:</label> 
                        <a class="w3-left w3-small w3-button" href="<?php echo base_url(); ?>inventory/manage_customers" style="padding:5px;margin:8px 0 0 5px"><i class="fa fa-plus"></i> Add Customer</a>
                    </div>
                </div>
            </div>

        </div><!--this div for customer for to quotation-->
        <div class="w3-col l12 w3-padding">
            <a id="btn-add-product" class="btn w3-text-red w3-left"><i class="fa fa-plus"></i> Add New Product </a>
        </div>
        <div class="w3-col l12"><!--this div for button for add product to quotation-->
            <button type="submit" id="add_enquiryBTN" class="btn w3-right btn-lg w3-blue w3-margin">Add Enquiry Details</button>
        </div> 
        <!--this div for button for add product to quotation-->
    </form>
</div>

<!-- Modal -->
<div id="myModalnew" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-title" id="msg_header"></div>
            </div>
            <div class="modal-body">
                <div id="addMaterials_err" name="addMaterials_err" class="w3-text-red"></div>
            </div>
            <div class="modal-footer">
                <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <!--\n\<div class="w3-col l12 w3-padding-left w3-margin-top w3-margin-bottom">\n\
    <button class="btn-add-siblings">Add Material</button>\n\
</div>\n\-->
    <!--  Script to reload page when enquiry modal closes............................
    --> 
    <script>
        $('#myModalnew').on('hidden.bs.modal', function () {
            location.reload();
        });
    </script>
    <!-- script end -->

    <script>
        //------------get best tube-------------
        function getBest_tube(fieldnum, countnum) {

            Materialinfo = 0;
            MaterialID = 0;
            MaterialOD = 0;
            MaterialLength = 0;
            Materialinfo = $('#Materialinfo_' + fieldnum + '_' + countnum + ' [value="' + $('#Select_material_' + fieldnum + '_' + countnum).val() + '"]').data('value');
            var MaterialID = [];
            var MaterialOD = [];
            var MaterialLength = [];
            var ID_tolerance=$('#ID_tolerance_' + fieldnum + '_' + countnum).val();
            var OD_tolerance=$('#OD_tolerance_' + fieldnum + '_' + countnum).val();

            $("#tube_spinner_" + fieldnum + '_' + countnum).html('<center><img width="100%" height="auto" src="'+BASE_URL+'css/logos/small_loader.gif"/></center>');

            $('#Div_no_' + fieldnum + '_' + countnum + ' input[name="Select_ID[' + fieldnum + '][]"]').each(function ()
            {
               if($(this).val() ){
                MaterialID.push($(this).val());
            }
        });
            $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_OD[" + fieldnum + "][]']").each(function ()
            {
               if($(this).val() ){
                MaterialOD.push($(this).val());
            }
        });
            $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_Length[" + fieldnum + "][]']").each(function ()
            {
               if($(this).val() ){
                MaterialLength.push($(this).val());
            }
        });
            $.ajax({
                type: "POST",
                url: BASE_URL + "inventory/Manage_enquiry/getBest_tube",
                data: {
                    Materialinfo: Materialinfo,
                    MaterialID: MaterialID,
                    MaterialOD: MaterialOD,
                    MaterialLength: MaterialLength,
                    ID_tolerance: ID_tolerance,
                    OD_tolerance: OD_tolerance
                },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#available_tube_' + fieldnum + '_' + countnum).html(data);
                    showAvailable_Tube(fieldnum,countnum);
                    $("#tube_spinner_" + fieldnum + '_' + countnum).html('');
                }
            });
        }
        //--------------get best tube end-----------------------
    </script>
    <script>
        function showAvailable_Tube(fieldnum,countnum){
            Materialinfo = 0;
            MaterialID = 0;
            MaterialOD = 0;
            MaterialLength = 0;
            Materialinfo = $('#Materialinfo_' + fieldnum + '_' + countnum + ' [value="' + $('#Select_material_' + fieldnum + '_' + countnum).val() + '"]').data('value');
            var MaterialID = [];
            var MaterialOD = [];
            var MaterialLength = [];
            if(document.getElementById('make_boughtOut_'+fieldnum+'_'+countnum).checked == false){
                $("#tube_spinner_" + fieldnum + '_' + countnum).html('<center><img width="100%" height="auto" src="'+BASE_URL+'css/logos/small_loader.gif"/></center>');
                $('#Div_no_' + fieldnum + '_' + countnum + ' input[name="Select_ID[' + fieldnum + '][]"]').each(function ()
                {
                    if($(this).val() ){
                        MaterialID.push($(this).val());
                    }
                });
                $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_OD[" + fieldnum + "][]']").each(function ()
                {
                    if($(this).val() ){
                        MaterialOD.push($(this).val());
                    }
                });
                $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_Length[" + fieldnum + "][]']").each(function ()
                {
                    if($(this).val() ){
                        MaterialLength.push($(this).val());
                    }
                });
                
                //getBest_tube(fieldnum, countnum);
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "inventory/Manage_enquiry/showAvailable_Tube",
                    data: {
                        Materialinfo: Materialinfo,
                        MaterialID: MaterialID,
                        MaterialOD: MaterialOD,
                        MaterialLength: MaterialLength
                    },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $("#tube_spinner_" + fieldnum + '_' + countnum).html('');
                    $('#Available_tube_' + fieldnum + '_' + countnum).val(data);
                    getAvailableTubeFromAllBranches(fieldnum, countnum);
                    GetMaterialBasePrice(fieldnum, countnum);
                    GetProductfinalPrice(fieldnum);
                }
            });
            }
        }
        //--------------get best tube end-----------------------
    </script>
    <script>
        function getAvailableTubeFromAllBranches(fieldnum, countnum){
            Materialinfo = $('#Materialinfo_' + fieldnum + '_' + countnum + ' [value="' + $('#Select_material_' + fieldnum + '_' + countnum).val() + '"]').data('value');
            Available_tube = $('#Available_tube_' + fieldnum + '_' + countnum).val();
            var MaterialLength = [];

            $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_Length[" + fieldnum + "][]']").each(function ()
            {
                if($(this).val() ){
                    MaterialLength.push($(this).val());
                }
            });
            var material_length=Math.max.apply(Math,MaterialLength);
            //document.getElementById('hiddentInputForBranch_Price_'+ fieldnum + '_' + countnum).value='1';

        //alert(Materialinfo);
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Manage_materials/getAvailableTubeFromAllBranches",
            data: {
                Materialinfo: Materialinfo,
                Available_tube: Available_tube,
                material_length: material_length,
                fieldnum: fieldnum,
                countnum: countnum
            },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#allbranchAvailable_tube_' + fieldnum + '_' + countnum).html(data);
                    $("#tube_spinner_" + fieldnum + '_' + countnum).html('');
                }
            });
    }
</script>
<script>
    function setMaterialTocheckbox(fieldnum, countnum){
        var Materialinfo =  $('#Select_material_' + fieldnum + '_' + countnum).val();
        document.getElementById('make_boughtOut_'+fieldnum+'_'+countnum).value = Materialinfo;
        document.getElementById('select_box_'+fieldnum+'_'+countnum).value = Materialinfo;        
    }
</script>
<script>
        //----this funis used to get value from table to perform bestprice calculations
        function GetMaterialBasePrice(fieldnum, countnum) {
            Materialinfo = 0;
            MaterialLength = 0;
            branchprice = 0;
            Materialinfo = $('#Materialinfo_' + fieldnum + '_' + countnum + ' [value="' + $('#Select_material_' + fieldnum + '_' + countnum + '').val() + '"]').data('value');

            var MaterialLength = [];
            $("#Div_no_" + fieldnum + "_" + countnum + " input[name='Select_Length[" + fieldnum + "][]']").each(function ()
            {
               if($(this).val() ){
                MaterialLength.push($(this).val());//--this is for get material length array...
            }
        });

            Available_tube = $('#Available_tube_' + fieldnum + '_' + countnum).val();

        //---if this hidden text box is value is 0 then perform the material bestprice  calculations
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Manage_enquiry/GetMaterialBasePrice",
            data: {
                Materialinfo: Materialinfo,
                MaterialLength: MaterialLength,
                Available_tube: Available_tube
            },
                return: false, //stop the actual form post !important!
                success: function (data)
                {   
                    //alert(data);
                    $('#Available_Price_' + fieldnum + '_' + countnum).val(data);
                    GetFinalPriceForMaterialCalculation(fieldnum, countnum);
                    GetProductfinalPrice(fieldnum);
                }
            });    
    }

//----this funis used to get value from table to perform bestprice calculations
</script>

<!-- script to get price by branch_name -->
<script>
    function getTubePrice_byBranch(fieldnum, countnum ,cellnum) {
        branchprice = document.getElementById('branch_id_'+ fieldnum + '_' + countnum + '_' +cellnum).value;
        Available_tube = $('#Available_tube_' + fieldnum + '_' + countnum).val();

        $.ajax({
            type: "POST",//----this funis used to get value from table to perform bestprice calculations
            url: BASE_URL + "inventory/Manage_enquiry/GetMaterialBasePrice_byBranchPrice",
            data: {               
                Available_tube: Available_tube,
                branchprice: branchprice
            },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#Available_Price_' + fieldnum + '_' + countnum).val(data);
                    GetFinalPriceForMaterialCalculation(fieldnum, countnum);
                }
            });
    }
</script>
<!-- script to get price by branch name ends -->

<!-- get customer id and profile id in hidden text input -->
<script>
    function getCustomerId() {
        var customer_id = $('#Customers option[value="' + $('#Select_Customers').val() + '"]').data('value');
        $('#customer_id').val(customer_id);
    }

</script>
<!-- script end -->

<!-- script to get final price -->
<script>
    function GetFinalPriceForMaterialCalculation(fieldnum, countnum) {
        finalprice = '0';
        if(document.getElementById('make_boughtOut_'+fieldnum+'_'+countnum).checked == false){
            quantity = $("#select_Quantity_" + fieldnum + "_" + countnum).val();
            discount = $("#discount_" + fieldnum + "_" + countnum).val();
            Available_Price = $("#Available_Price_" + fieldnum + "_" + countnum).val();
            if (discount === '' && quantity === '') {
                finalprice = Available_Price;
            } else if (discount === '') {
                finalprice = ((Available_Price) * (quantity));
            } else if (quantity === '') {
                finalprice = ((Available_Price) - (((discount) / 100) * (parseFloat(Available_Price))));
            } else if (discount !== '' && quantity !== '') {
                finalprice = (((Available_Price) * (quantity)) - (((discount) / 100) * ((Available_Price) * (quantity))));
            }
            $("#final_Price_" + fieldnum + "_" + countnum).val(finalprice.toFixed(2));
            GetProductfinalPrice(fieldnum);
        }
    }
</script>
<!-- script end -->

<!-- script to get final price -->
<script>
    function makeBought_out(fieldnum, countnum) {

        if(document.getElementById('make_boughtOut_'+fieldnum+'_'+countnum).checked){
            //Available tube and discount disable/enable change
            document.getElementById('Available_tube_'+fieldnum+'_'+countnum).value = 'N/A';
            document.getElementById('Available_tube_'+fieldnum+'_'+countnum).disabled = true;
            document.getElementById('available_tubeDiv_'+fieldnum+'_'+countnum).disabled = true;
            document.getElementById('discount_'+fieldnum+'_'+countnum).disabled = true;
            document.getElementById('available_tubebtn_'+fieldnum+'_'+countnum).disabled = true;
            document.getElementById('select_box_'+fieldnum+'_'+countnum).checked = true;


            //Available price disable/enable change
            document.getElementById('Available_Price_'+fieldnum+'_'+countnum).value = '0.00';
            document.getElementById('Available_Price_'+fieldnum+'_'+countnum).disabled = true;
        }
        else{
            //Available tube and discount disable/enable change
            document.getElementById('Available_tube_'+fieldnum+'_'+countnum).value = '';
            document.getElementById('Available_tube_'+fieldnum+'_'+countnum).disabled = false;
            document.getElementById('available_tubeDiv_'+fieldnum+'_'+countnum).disabled = false;
            document.getElementById('discount_'+fieldnum+'_'+countnum).disabled = false;

            //Available price disable/enable change
            document.getElementById('Available_Price_'+fieldnum+'_'+countnum).value = '';
            document.getElementById('Available_Price_'+fieldnum+'_'+countnum).disabled = false;
        }
    }
</script>
<!-- script end -->

<!-- script function to mkae final prize of material 0 when material is excluded -->
<script>
    function excludeMaterial(fieldnum,countnum)    {

      if(document.getElementById('select_box_'+fieldnum+'_'+countnum).checked == false){
        document.getElementById('make_boughtOut_'+fieldnum+'_'+countnum).checked = false;
        document.getElementById('Available_tube_'+fieldnum+'_'+countnum).value = '';
        document.getElementById('Available_tube_'+fieldnum+'_'+countnum).disabled = false;
        document.getElementById('available_tubeDiv_'+fieldnum+'_'+countnum).disabled = false;
        document.getElementById('discount_'+fieldnum+'_'+countnum).disabled = false;

        //Available price disable/enable change
        document.getElementById('Available_Price_'+fieldnum+'_'+countnum).value = '';
        document.getElementById('Available_Price_'+fieldnum+'_'+countnum).disabled = false;
    }
}
</script> 
<!-- script ends -->
</body>
</html>