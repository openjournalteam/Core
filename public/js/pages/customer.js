"use strict";
// Class definition


var OJTCustomer = function () {
  var init = function () {
    $(document).on('change', '#customer_name', function () {

      var customer_name = $(this).val();

      if (customer_name) {

        let randomUsername = customer_name.replace(/\s+/g, '') + '_' + OJTApp.randomstring(5);

        $('#customer_username').val(randomUsername);
      } else {
        $('#customer_username').val('');
      }

    });
  } 

  return {
    init: function () {
      init();
    },
  }
}();

OJTCustomer.init();