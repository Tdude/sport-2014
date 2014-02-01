jQuery(document).ready(function($) {
	
  // validate signup form on keyup and submit
  $("#order-form").validate({
    rules: {
      ShipToFirstname: "required",
      ShipToLastname: "required",
      ShipToAddress: {
        required: true,
        minlength: 3
      },
      ShipToPostalCode: {
        required: true,
        minlength: 5
      },
      ShipToCity: {
        required: true,
        minlength: 2
      },
      ShipToEmail: {
        required: true,
        email: true
      },
      QuantitySportmarketing: {
        required: true,
        minlength: 1
      }
    },
    messages: {
      ShipToFirstname: "Fyll i ditt förmamn!",
      ShipToLastname: "Fyll i ditt efternamn!",
      ShipToEmail: "Fyll i en giltig e-postadress!",
      QuantitySportmarketing: "Skriv antal böcker som du vill beställa!"
    }
  });








// FORM SLIDE OUT

    $("#sliding-content").css("display","none");

    $("#ShipToEmail").click(function(){
        $("#sliding-content").slideDown("fast"); //Slide Down Effect
    });






 }); // Docready


