$(function () {
  $(".add_user").click(function (e) {
    $("#email").rules("add", {
      remote: {
        url: adminUrl + "/admin/user/check_email",
        type: "post",
      },
      messages: {
        remote: "Email already exist",
      },
    });
    $("#password-edit-hint").hide();
  });
  $(document).on("click", ".edit_user", function (event) {
    $("#password-edit-hint").show();
    $("#email").rules("remove");
    $("#password").rules("remove");
  });

  $("#password_confirmation").rules("add", {
    equalTo: "#password",
    minlength: 8,
    messages: {
      equalTo: jQuery.validator.format("Please enter the same password."),
    },
  });
  $("#password").rules("add", {
    required: true,
    minlength: 8,
  });
  // Roles Javascript
  $("#role_name").rules("add", {
    remote: {
      url: adminUrl + "/admin/role/check_name",
      type: "post",
    },
    messages: {
      remote: "Roles already exist",
    },
  });
});
