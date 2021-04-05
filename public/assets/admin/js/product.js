(function ($) {
    "use strict";

    $(document).ready(function () {

        // Check Click1 :)
        $(".checkclick1").on("change", function () {
            if (this.checked) {
                $(this).parent().parent().parent().parent().next().removeClass('showbox');
            }
            else {
                $(this).parent().parent().parent().parent().next().addClass('showbox');
            }
        });
        // Check Click1 Ends :)


        // Product Measure :)

        $("#product_measure").on("change", function () {
            var val = $(this).val();
            $('#measurement').val(val);
            if (val == "Custom") {
                $('#measurement').val('');
                $('#measure').show();
            }
            else {
                $('#measure').hide();
            }
        });

        // Product Measure Ends :)

    });

    // TAGIT

    $("#metatags").tagit({
        fieldName: "meta_tag[]",
        allowSpaces: true
    });

    $("#tags").tagit({
        fieldName: "tags[]",
        allowSpaces: true
    });
    // TAGIT ENDS


    // Remove White Space


    function isEmpty(el) {
        return !$.trim(el.html())
    }


    // Remove White Space Ends

    // Size Section

    $("#size-btn").on('click', function () {
        $("#size-section").append('' +
            '<div class="size-area">' +
            '<div class="row px-3">' +
            '<div class="input-group">' +
            '<input type="text" name="size[]" class="form-control " placeholder="Name (eg. S,M,L,XL,XXL,3XL,4XL)">' +

            '<input type="number" name="size_qty[]" class="form-control" placeholder="Quantity - 1" value="Price - eg. 02.20" min="1">' +

            '<input type="number" name="size_price[]" class="form-control " placeholder="Price - eg. 02.20" value="Price - eg. 02.20" min="0" step=".001">' +

            '<span class="input-group-text size-remove text-danger"><i class="fas fa-trash"></i></span>' +

            '</div>' +

            '</div>' +
            '</div>' +
            '');

    });

    $(document).on('click', '.size-remove', function () {
        $(this.parentNode).remove();
        if (isEmpty($('#size-section'))) {

            $("#size-section").append('' +
                '<div class="size-area">' +
                '<div class="row px-3">' +
                '<div class="input-group">' +
                '<input type="text" name="size[]" class="form-control " placeholder="Name (eg. S,M,L,XL,XXL,3XL,4XL)">' +

                '<input type="number" name="size_qty[]" class="form-control" placeholder="Quantity - 1" value="Price - eg. 02.20" min="1">' +

                '<input type="number" name="size_price[]" class="form-control " placeholder="Price - eg. 02.20" value="Price - eg. 02.20" min="0" step=".001">' +

                '<span class="input-group-text size-remove text-danger"><i class="fas fa-trash"></i></span>' +

                '</div>' +

                '</div>' +
                '</div>' +
                '');


        }

    });

    // Size Section Ends

    // Package Section Start

    $("#package-weight-btn").on('click', function () {
        $("#package-section").append('' +
            '<div class="size-area">' +
            '<span class="remove package-remove"><i class="fas fa-trash"></i></span>' +
            '<div class="row px-3">' +
            '<div class="col-md-4 col-sm-4">' +
            '<label>' +
            'Package Weight :' +
            '</label>' +
            '<div class="select-input-color">' +
            '<div class="color-area">' +
            '<div class="input-group">' +
            '<input type="number" name="wieight" value="" placeholder="Weight" class="input-field" step=".001" />' +
            '<span class="input-group-addon"><i>Kg</i></span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-8 col-sm-4">' +
            '<label>' +
            'Package Dimenisions - L × W × H' +
            '</label>' +
            '<div class="row">' +
            '<div class="col-md-4">' +
            '<input type="number" name="length" class="input-field" placeholder="Length" step=".001" />' +
            '</div>' +
            '<div class="col-md-4">' +
            '<input type="number" name="width" class="input-field" placeholder="Width" step=".001" />' +
            '</div>' +
            '<div class="col-md-4">' +
            '<input type="number" name="height" class="input-field" placeholder="Height" step=".001" />' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-4 col-sm-4">' +
            '<label>' +
            'Cubic Meters (m³)' +

            '</label>' +
            '<div class="select-input-color">' +
            '<div class="color-area">' +
            '<div class="input-group">' +
            '<input type="number" name="cubic_meter[]" class="input-field" placeholder="Cubic Meters (m³)" step=".001" value="" min="0"/>' +
            '<span class="input-group-addon"><i>m³</i></span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
            + '');

    });

    $(document).on('click', '.package-remove', function () {
        $(this.parentNode).remove();
        if (isEmpty($('#package-section'))) {

            $("#package-section").append('' +
                '<div class="size-area">' +
                '<span class="remove package-remove"><i class="fas fa-trash"></i></span>' +
                '<div class="row px-3">' +
                '<div class="col-md-4 col-sm-4">' +
                '<label>' +
                'Package Weight :' +
                '</label>' +
                '<div class="select-input-color">' +
                '<div class="color-area">' +
                '<div class="input-group">' +
                '<input type="number" name="wieight" value="" placeholder="Weight" class="input-field" step=".001"/>' +
                '<span class="input-group-addon"><i>Kg</i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-8 col-sm-4">' +
                '<label>' +
                'Package Dimenisions - L × W × H' +
                '</label>' +
                '<div class="row">' +
                '<div class="col-md-4">' +
                '<input type="number" name="length" class="input-field" placeholder="Length" step=".001"/>' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="number" name="width" class="input-field" placeholder="Width" step=".001" />' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="number" name="height" class="input-field" placeholder="Height" step=".001"/>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4 col-sm-4">' +
                '<label>' +
                'Cubic Meters (m³)' +

                '</label>' +
                '<div class="select-input-color">' +
                '<div class="color-area">' +
                '<div class="input-group">' +
                '<input type="number" name="cubic_meter" class="input-field" placeholder="Cubic Meters (m³)" value="" min="0" step=".001">' +
                '<span class="input-group-addon"><i>m³</i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
                + '');


        }

    });

    // Package Section Ends


    // Color Section

    $("#color-btn").on('click', function () {

        $("#color-section").append('' +
            '<div class="row px-3 ">' +
            '<div class="col-md-4 col-sm-6 select-input-color cp  mb-0">' +
            '<div class="input-group-prepend ">' +
            '<button class="btn btn-outline-secondary input-group-addon new-addon new-colors" type="button" id="new_one_colors"><span class="fa fa-angle-down"></span></button>' +
            '<input type="text" name="color[]" value="#ffcb48" class="input-field cp text-center form-control" />' +

            '</div>' +


            '</div>' +

            '<div class="col-md-4 col-sm-6">' +
            '<div class="input-group">' +
            '<input name="add_photo[]" type="file" class="input-field  form-control" placeholder="Add Photo">' +

            '</div>' +

            '</div>' +

            '<span class="input-group-text color-remove text-danger" style="height: 45px;" ><i class="fas fa-trash"></i></span>' +

            '</div>' +
            '');
        $('.cp').colorpicker();
    });


    $(document).on('click', '.color-remove', function () {

        $(this.parentNode).remove();
        if (isEmpty($('#color-section'))) {

            $("#color-section").append('' +
                '<div class="row px-3 ">' +
                '<div class="col-md-4 col-sm-6 select-input-color cp  mb-0">' +
                '<div class="input-group-prepend ">' +
                '<button class="btn btn-outline-secondary input-group-addon new-addon new-colors" type="button" id="new_one_colors"><span class="fa fa-angle-down"></span></button>' +
                '<input type="text" name="color[]" value="#ffcb48" class="input-field cp text-center form-control" />' +

                '</div>' +


                '</div>' +

                '<div class="col-md-4 col-sm-6">' +
                '<div class="input-group">' +
                '<input name="add_photo[]" type="file" class="input-field  form-control" placeholder="Add Photo">' +

                '</div>' +

                '</div>' +

                '<span class="input-group-text color-remove text-danger" style="height: 45px;" ><i class="fas fa-trash"></i></span>' +

                '</div>' +
                '');
            $('.cp').colorpicker();
        }

    });

    // Color Section Ends


    // Feature Section

    $("#feature-btn").on('click', function () {

        $("#feature-section").append('' +
            '<div class="feature-area">' +
            '<span class="remove feature-remove"><i class="fas fa-trash"></i></span>' +
            '<div  class="row">' +
            '<div class="col-lg-6">' +
            '<input type="text" name="features[]" class="input-field" placeholder="Enter Your Keyword">' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<div class="input-group colorpicker-component cp">' +
            '<input type="text" name="colors[]" value="#000000" class="input-field cp"/>' +
            '<span class="input-group-addon"><i></i></span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
            + '');
        $('.cp').colorpicker();
    });

    $(document).on('click', '.feature-remove', function () {

        $(this.parentNode).remove();
        if (isEmpty($('#feature-section'))) {

            $("#feature-section").append('' +
                '<div class="feature-area">' +
                '<span class="remove feature-remove"><i class="fas fa-trash"></i></span>' +
                '<div  class="row">' +
                '<div class="col-lg-6">' +
                '<input type="text" name="features[]" class="input-field" placeholder="Enter Your Keyword">' +
                '</div>' +
                '<div class="col-lg-6">' +
                '<div class="input-group colorpicker-component cp">' +
                '<input type="text" name="colors[]" value="#000000" class="input-field cp"/>' +
                '<span class="input-group-addon"><i></i></span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
                + '');
            $('.cp').colorpicker();
        }

    });

    // Feature Section Ends
    // Type Check

    $('#type_check').on('change', function () {
        var val = $(this).val();
        if (val == 1) {
            $('.row.file').css('display', 'flex');
            $('.row.file').find('input[type=file]').prop('required', true);
            $('.row.link').find('textarea').val('').prop('required', false);
            $('.row.link').hide();
        }
        else {
            $('.row.file').hide();
            $('.row.link').css('display', 'flex');
            $('.row.file').find('input[type=file]').prop('required', false);
            $('.row.link').find('textarea').prop('required', true);
        }

    });

    // Type Check Ends



    // License Section

    $("#license-btn").on('click', function () {

        $("#license-section").append('' +
            '<div class="license-area">' +
            '<span class="remove license-remove"><i class="fas fa-trash"></i></span>' +
            '<div  class="row">' +
            '<div class="col-lg-6">' +
            '<input type="text" name="license[]" class="input-field" placeholder="License Key" required="">' +
            '</div>' +
            '<div class="col-lg-6">' +
            '<input type="number" name="license_qty[]" min="1" class="input-field" placeholder="License Quantity" value="1">' +
            '</div>' +
            '</div>' +
            '</div>'
            + '');
    });

    $(document).on('click', '.license-remove', function () {

        $(this.parentNode).remove();
        if (isEmpty($('#license-section'))) {

            $("#license-section").append('' +
                '<div class="license-area">' +
                '<span class="remove license-remove"><i class="fas fa-trash"></i></span>' +
                '<div  class="row">' +
                '<div class="col-lg-6">' +
                '<input type="text" name="license[]" class="input-field" placeholder="License Key" required="">' +
                '</div>' +
                '<div class="col-lg-6">' +
                '<input type="number" name="license_qty[]" min="1" class="input-field" placeholder="License Quantity" value="1">' +
                '</div>' +
                '</div>' +
                '</div>'
                + '');
        }

    });

    // License Section Ends

    $("#size-check").change(function () {
        if (this.checked) {
            $("#size-display").show();
            $("#stckprod").hide();
        }
        else {
            $("#size-display").hide();
            $("#stckprod").show();

        }
    });

    $("#whole_check").change(function () {
        if (this.checked) {
            $("#whole-section input").prop('required', true);
        }
        else {
            $("#whole-section input").prop('required', false);
        }
    });


    // Whole Sell Section

    $("#whole-btn").on('click', function () {

        if (whole_sell > $("[name='whole_sell_qty[]']").length) {
            $("#whole-section").append('' +
                '<div class="feature-area">' +
                '<div  class="row px-3">' +
                '<div class="col-md-4 col-sm-6">' +
                '<input type="text" name="whole_sell_qty[]" class="input-field" placeholder="MOQ(Unit) - 1-10" required>' +
                '</div>' +
                '<div class="col-md-4 col-sm-6">' +
                '<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="Price(Unit) - 2.09" step=".001" required>' +
                '</div>' +

                '<span class="input-group-text whole-remove text-danger"><i class="fas fa-trash"></i></span>' +
                '</div>' +
                '</div>'
                + '');
        }
    });

    $(document).on('click', '.whole-remove', function () {

        $(this.parentNode).remove();
        if (isEmpty($('#whole-section'))) {

            $("#whole-section").append('' +
                '<div class="feature-area">' +
                '<div  class="row px-3">' +
                '<div class="col-md-4 col-sm-6">' +
                '<input type="text" name="whole_sell_qty[]" class="input-field" placeholder="MOQ(Unit) - 1-10" required>' +
                '</div>' +
                '<div class="col-md-4 col-sm-6">' +
                '<input type="number" name="whole_sell_discount[]" class="input-field" placeholder="Price(Unit) - 2.09" step=".001" required>' +
                '</div>' +

                '<span class="input-group-text whole-remove text-danger"><i class="fas fa-trash"></i></span>' +
                '</div>' +
                '</div>'
                + '');
        }

    });

    // Whole Sell Section Ends


})(jQuery);




