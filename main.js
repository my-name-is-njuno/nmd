jQuery(document).ready(function () {

  $( "#proposed_date" ).datepicker();

  jQuery('#bappt').click(function (e) {
    e.preventDefault();


    var name = $("#name").val();
    if (name == "") {
      // alert("Name not Filled")
      sweetAlert('Error', 'Kindly fill your name', 'error');
      return false;
    }
    var email = $("#email").val();
    if (email == "") {
      sweetAlert('Error', 'Your email is empty', 'error');
      return false;
    }
    var phone = $("#phone").val();
    if (phone == "") {
      sweetAlert('Error', 'Enter your Phone number', 'error');
      return false;
    }

    var proposed_date = $("#proposed_date").val();
    if (proposed_date == "") {
      sweetAlert('Error', 'Enter a valid date', 'error');
      return false;
    }
    if (new Date(proposed_date) === NaN) {
      sweetAlert('Error', 'Enter a valid date', 'error');
      return false;
    }



    jQuery.ajax({

      type: 'POST',
      url: "sendemail.php",
      data: {
        name: jQuery('#name').val(),
        email: jQuery('#email').val(),
        phone: jQuery('#phone').val(),
        proposed_date: jQuery('#proposed_date').val()
      },
      success: function (result) {


        jQuery('#name').val("")
        jQuery('#email').val("")
        jQuery('#phone').val("")
        jQuery('#proposed_date').val("")


        sweetAlert('Success', 'Your appointment Request sent successfully, you will receive communication from us soon', 'success');

      },
      error: function (jqXHR, textStatus, errorThrown) { 
        jQuery('#name').val("")
        jQuery('#email').val("")
        jQuery('#phone').val("")
        jQuery('#proposed_date').val("")

        sweetAlert('Error', 'Your appointment had a error, please try again', 'error');
        // window.location.reload()
      }

    });
  })
});
