$('#bKash_button').click(function() {

    var bkashExpiredTime = 5; // 3 seconds

    $(this).prop("disabled",true);
    $(this).html('Please wait ' + bkashExpiredTime + ' seconds');

    var counter = bkashExpiredTime;

    console.log(counter);

    var x = setInterval(function() {

        counter--;

        console.log(counter);

        $('#bKash_button').html('Please wait ' + counter + ' seconds');

        if(counter == 0) {

            console.log('after 3 seconds');
            
            $('#bKash_button').html("Continue");
            $('#bKash_button').prop("disabled",false);

            clearInterval(x);
        }
    },1000);

});