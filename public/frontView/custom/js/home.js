$(document).ready(function() {
    $(".TRAINEES").hide();
    $(".DELEGATES").hide();
    $("#amount").val('0.00');
    $(".showAmountDiv").hide();
    $('input[name="packageCategory"]').prop('checked', false);
    $('.changePackageCategory').change(function() {
        let package = $(this).val();
        $("#amount").val('0.00');
        $("#showAmount").html('0.00');
        $(".showAmountDiv").hide();
        $('input[name="durationPresent"]').prop('checked', false);
        if(package==1){
            $(".TRAINEES").hide();
            $(".DELEGATES").show();
            $("#amount").val('0.00');
            $("#showAmount").html('0.00');
        }else{
            $(".TRAINEES").show();
            $(".DELEGATES").hide();
            $(".showAmountDiv").show();
            $("#amount").val('3000.00');
            $("#showAmount").html('3000.00');

            // $("#amount").val('1.00');
            // $("#showAmount").html('1.00');
        }

    });
    $('.delegatesSubCtg').change(function() {
        $(".showAmountDiv").show();
        let days = $(this).val();
        if(days==1){
            $("#amount").val('3000.00');
            $("#showAmount").html('3000.00');
        }else if(days==2){
            $("#amount").val('5000.00');
            $("#showAmount").html('5000.00');
        }else{
            $("#amount").val('5000.00');
            $("#showAmount").html('5000.00');
        }
    });

});



