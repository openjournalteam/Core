"use strict";

// Class definition

var OJTForm = (function () {
  // Private functions
  var setupHeader = function () {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  };
  var ajaxError = function (data, statusText, xhr, form) {
    let json = data.responseJSON;

    if (data.status == 422) {
      handleUnprocessableEntity(data, form);
    }

    Toast.fire({
      icon: "error",
      title:
        json?.message ??
        json?.error ??
        "Something went wrong,please contact the developer",
    });

    unblockForm(form);
  };

  var handleUnprocessableEntity = function (data, form) {
    let json = data.responseJSON;
    let errors = json.errors;

    $.each(errors, function (key, value) {
      //find the dom by keyString
      let input = form.find(`[name="${key}"]`);
      let parent = input.parent();

      input.addClass("is-invalid");
      parent.append(`<div class="invalid-feedback">${value}</div>`);
    });
  };

  var ajaxBeforeSubmit = function (arr, form, options) {
    form.find(".is-invalid").removeClass("is-invalid");
    form.find(".invalid-feedback").remove();

    blockForm(form);
  };

  var blockForm = function (form) {
    let submitButton = form.find("[type='submit']");

    submitButton.attr("disabled", "disabled");
    submitButton.addClass("btn-loading");
  };

  var unblockForm = function (form) {
    let submitButton = form.find("[type='submit']");

    submitButton.removeAttr("disabled");
    submitButton.removeClass("btn-loading");
  };

  var initFormValidation = function (form) {
    $(form).validate({
      errorClass: "invalid-feedback",
      highlight: function (element, errorClass) {
        $(element).addClass("is-invalid");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
      },
      submitHandler: function (form) {
        let resetForm = $(form).attr("reset-form") ?? false;
        let clearForm = $(form).attr("clear-form") ?? false;
        let callback = $(form).attr("callback") ?? false;
        let method = $(form).attr("method") ?? "POST";
        let url =
          method == "PUT" || method == "PATCH"
            ? $(form).attr("action") + "/" + $(form).data("id")
            : $(form).attr("action");

        var ajaxOptions = {
          error: ajaxError,
          clearForm: clearForm,
          beforeSubmit: ajaxBeforeSubmit,
          resetForm: resetForm,
          method: method,
          url: url,
        };

        $.ajaxSetup({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        });

        let submit = $(form).ajaxSubmit(ajaxOptions);
        let xhr = submit.data("jqxhr");

        var payLoad = {};

        $.each($(form).serializeArray(), function (i, field) {
          payLoad[field.name] = field.value;
        });

        xhr.done(function (response) {
          if (typeof OJTDatatables !== "undefined") OJTDatatables.reload();

          if (typeof Livewire != "undefined") Livewire.emit("refresh");

          let dropzoneElement = $(form).find(".dropzones");
          if (dropzoneElement.length > 0) {
            Dropzone.forElement(dropzoneElement[0]).emit("resetFiles");
          }

          Toast.fire({
            icon: response?.success ? "success" : "error",
            title: response?.success ? response.data.msg : response.error,
          });

          if (response?.data.redirect) {
            window.location = response?.data.redirect;
          }

          unblockForm($(form));

          if ($(form)?.attr("prevent-close") !== "true") {
            $(".modal").modal("hide");
          }

          if (typeof callback !== typeof undefined && callback !== false) {
            if (callback.includes(".")) {
              let callBackArray = callback.split(".");
              window[callBackArray[0]][callBackArray[1]](
                form,
                payLoad,
                response
              );
            } else {
              window[callback]();
            }
          }
        });
      },
    });
  };

  var initFormValidations = function () {
    $('.ajax_form, [data-control="form"]').each(function () {
      initFormValidation(this);
    });
  };

  var assignFormInputByJsonKey = function (form, json) {
    if (!(form instanceof jQuery)) form = $(form);

    $.each(json, function (key, value) {
      if (!value) return;
      // var input = form.find(`[name^="${key}"]`);
      var input = form.find(`[name="${key}"]`);
      input = input.length > 0 ? input : form.find(`[name="${key}[]"]`);

      if (key == "attachment") {
        let dropzoneElement = $(form).find(".dropzones");
        if (dropzoneElement.length == 0) return;

        let dz = Dropzone.forElement(dropzoneElement[0]);
        let acceptMimeTypeImage = [
          "image/jpeg",
          "image/png",
          "image/gif",
          "image/bmp",
          "image/tiff",
          "image/webp",
          "image/vnd.adobe.photoshop",
          "image/x-icon",
        ];
        value.forEach(function (media) {
          let mockFile = {
            uuid: media.uuid,
            name: media.name,
            size: media.size,
            mimeType: media.mime_type,
            accepted: true,
          };

          dz.displayExistingFile(mockFile, media.url);

          let dom = $(mockFile.previewElement);

          if (!acceptMimeTypeImage.includes(media.mime_type)) {
            dom.find("[data-dz-thumbnail]").remove();
          }
          dom.addClass("dz-success");
          dom.addClass("dz-complete");
          dom.find(".progress").hide();
          dz.files.push(mockFile);
        });

        if (
          dz.options.maxFiles != null &&
          dz.files.length >= dz.options.maxFiles
        ) {
          dropzoneElement.find(".fileinput-button").hide();
        }

        return;
      }

      if (input.data("control") == "select2ajax") {
        if (typeof value == "object") {
          let newOption = new Option(value.text, value.id, false, true);
          // Append it to the select
          input.append(newOption).trigger("change");
          return;
        }

        $.each(value, function (key2, data) {
          let newOption = new Option(data.text, data.id, false, true);
          // Append it to the select
          input.append(newOption).trigger("change");
        });
        return;
      }

      if (input.prop("tagName") == "SELECT") {
        input.val(value).trigger("change");
        return;
      }

      if (OJTApp.hasJsonStructure(value)) {
        let json2 = OJTApp.safeJsonParse(value);
        assignFormInputByJsonKey(form, json2);
        return;
      }

      if (input.attr("type") == "checkbox") {
        // Still figuring out how checkbox generally works
        return;
      }

      // For intl-tel-input
      if (
        input.prev().hasClass("iti") &&
        input.attr("id").includes("country") &&
        value
      ) {
        if (value) input.val(value);
        if (!intlTelInputGlobals) return;

        let dom = document.querySelector(
          "#" + input.attr("id").replace("_country", "")
        );
        let iti = intlTelInputGlobals.getInstance(dom);
        iti.setCountry(value);
        return;
      }
      input.val(value);
      return;
    });
  };

  var modalEditForm = function (dom) {
    let el = $(dom);
    let json = el.data("json");
    let url = el.data("url");

    let modal = $(el.data("bs-target"));

    if (typeof json === "undefined" && typeof url === "undefined") {
      console.log("Attribute data-json or data-url not found");
      return;
    }

    if (typeof json === "undefined") {
      $.get(url, (data) => assignFormInputByJsonKey(modal, data));
      return;
    }

    assignFormInputByJsonKey(modal, json);
  };

  var initModalEditForm = function () {
    $(document).on("click", ".edit_form_modal", function () {
      modalEditForm($(this));
    });

    // on hidden reset form
    $(".modal").on("hidden.bs.modal", function (e) {
      let modal = $(this);

      let form = modal.find('.ajax_form, [data-control="form"]');

      if (form.length == 0) {
        return;
      }

      form[0].reset();
      form.find("select").val("").trigger("change");
      form.find(".is-invalid").removeClass("is-invalid");
      form.find(".invalid-feedback").remove();
      form.find("input[name='id'][type='hidden']").removeAttr("value");
      form.find("select[data-control='select2ajax']").empty();

      let dropzoneElement = form.find(".dropzones");
      dropzoneElement.find(".fileinput-button").show();

      if (dropzoneElement.length > 0) {
        let dz = Dropzone.forElement(dropzoneElement[0]);
        dz.emit("resetFiles");
      }
    });
  };

  var initDeleteConfirm = function () {
    $(document).on(
      "click",
      ".delete_confirm, [data-control='delete']",
      function (e) {
        e.preventDefault();

        let url = $(this).attr("href") ?? $(this).data("url");
        let callback = $(this).attr("callback");
        if (typeof url === "undefined") {
          console.log("Attribute href or data-url not found");
        }

        deleteConfirm(url, callback);
      }
    );
  };

  var deleteConfirm = function (url, callback = false) {
    Swal.fire({
      title: "Are you sure want to delete this ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then(function (result) {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          url: url,
          success: function (response) {
            Toast.fire({
              icon: response?.success ? "success" : "error",
              title: response?.success ? response.data.msg : response.error,
            });
            if (Livewire) {
              Livewire.emit("refresh");
            }
            if (typeof OJTDatatables !== "undefined") OJTDatatables.reload();

            if (typeof callback !== typeof undefined && callback !== false)
              window[callback]();
          },
          error: function (response) {
            Toast.fire({
              icon: "error",
              title: response.responseJSON.message,
            });
          },
        });
      }
    });
  };

  var initSelect2Ajax = function () {
    let dom = $('[data-control="select2ajax"]');
    dom.each(function () {
      select2Ajax(this);
    });
  };

  var select2Ajax = function (dom) {
    if (!(dom instanceof jQuery)) {
      dom = $(dom);
    }

    var options = {
      theme: dom.data("theme") ?? "bootstrap-5",
      width: dom.data("width") ?? "resolve",
      selectionCssClass: "form-control",
      dropdownCssClass: "select2--small",
      ajax: {
        data: function (params) {
          var query = {
            search: params.term,
          };

          // Query parameters will be ?search=[term]&type=public
          return query;
        },
      },
    };

    if (dom.data("minimuminputlength")) {
      options.minimumInputLength = dom.data("minimuminputlength");
    }

    dom.select2(options);
  };

  var initGenerateToken = function () {
    $(document).on("click", ".generate_token", function (e) {
      e.preventDefault();
      let id = $(this).attr("data-bs-target");
      let random_string = OJTApp.generateToken(20);
      $(id).find("input.generatedToken").val(random_string);
      $(id).find("input[name='token']").val(random_string);
    });
  };

  return {
    // public functions
    init: function () {
      setupHeader();
      initFormValidations();
      initModalEditForm();
      initDeleteConfirm();
      initSelect2Ajax();
      initGenerateToken();
    },
    initFormValidation: function (dom) {
      initFormValidation(dom);
    },
    deleteConfirm: function (url, callback) {
      deleteConfirm(url, callback);
    },
    assignFormInputByJsonKey: function (form, json) {
      assignFormInputByJsonKey(form, json);
    },
  };
})();

OJTForm.init();
