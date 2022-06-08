"use strict";
// Class definition

var OJTDropzones = (function () {
  var options = {
    url: baseUrl + "/attachment",
    maxFilesize: 10,
    acceptedFiles:
      ".csv,.txt,.xlx,.xls,.pdf,.gif,.jpeg,.jpg,.png,.pdf,.gif,.xls,.xlsx,.txt,.geojson,.doc,.docx",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    maxFiles: 1,
    thumbnailWidth: 400,
    thumbnailHeight: 400,
    thumbnailMethod: "contain",
    autoQueue: true,
    chunking: true,
    chunkSize: 1024 * 1024 * 10, // 10 MB
  };

  var mergeOptions = function (...objs) {
    return $.extend(options, ...objs);
  };

  var initUsingJsTemplate = function (dom) {
    var fileInputId = "fileinput_" + OJTApp.randomstring();
    var name = $(dom).attr("name") ?? "file";
    var placeholder =
      $(dom).attr("placeholder") ??
      "Drag & Drop your files or&nbsp;<u>Browse</u>";
    var template = `<div class="dropzones" data-media="${name}">
      <div class="dropzone-template m-1 p-1">
          <div class="file row align-items-center">
              <div class="col-8">
                  <div class="d-flex">
                    <div class="name" data-dz-name></div>
                    <div class="dz-success-mark ms-1"><span>✔</span></div>
                    <div class="dz-error-mark ms-1"><span>✘</span></div>
                  </div>
                  <small class="size" data-dz-size></small>
                  <div>
                      <small class="error text-danger"></small>
                  </div>
              </div>
              <div class="col-4 d-flex">
                  <button data-dz-remove class="btn btn-icon btn-sm btn-circle ms-auto"
                      aria-label="Button">
                      <i class="bi bi-x-lg"></i>
                  </button>
              </div>
          </div>
          <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="75" style="display: none"
                  aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
          </div>
          <div class="dz-thumbnail">
              <img data-dz-thumbnail class="thumbnail img-thumbnail" style="display: none" />
          </div>
      </div>
      <div class="d-grid">
          <span class="w-100 fileinput-button my-2 text-center" id="${fileInputId}">
              ${placeholder}
          </span>
      </div>
    </div>`;
    let jqDom = $(dom);
    // Get option from dom
    var options = {
      url: jqDom.data("url") ?? baseUrl + "/attachment",
      maxFilesize: jqDom.data("max-file-size") ?? 500,
      acceptedFiles:
        jqDom.attr("accept") ??
        ".csv,.txt,.xlx,.xls,.pdf,.gif,.jpeg,.jpg,.png,.pdf,.gif,.xls,.xlsx,.txt,.geojson,.doc,.docx,.zip,.rar,.tar.gz",
      maxFiles: jqDom.attr("multiple") ? null : 1,
      clickable: "#" + fileInputId, // Define the element that should be used as click trigger to select files.
    };

    options = mergeOptions(options);

    let parent = jqDom.parent();

    // Add the dropzone template
    jqDom.replaceWith(template);
    jqDom = parent.find(".dropzones");

    return init(name, jqDom, options);
  };

  var init = function (inputName, jqDom, options) {
    if (!(jqDom instanceof jQuery)) jqDom = $(jqDom);
    // Get the template HTML and remove it from the document template HTML and remove it from the doument
    var previewNode = jqDom.find(".dropzone-template")[0];
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);
    var previewsContainer = jqDom[0];

    options.previewsContainer = previewsContainer;
    options.previewTemplate = previewTemplate;

    var myDropzone = new Dropzone(previewsContainer, options);

    myDropzone.on("thumbnail", function (file) {
      $(file.previewElement).find(".thumbnail").fadeIn();
    });

    myDropzone.on("processing", function (file) {
      $(file.previewElement).find(".progress").fadeIn();
    });

    myDropzone.on("success", function (file, response) {
      $(file.previewElement).find(".progress").fadeOut();

      // Add download link
      if ($(file.previewElement).find("[data-dz-download]").length > 0) {
        $(file.previewElement)
          .find("[data-dz-download]")
          .attr(
            "href",
            baseUrl + "/attachment/download_temporary_file/" + response
          );
      }

      // Add hidden input
      let fileName = this.options.maxFiles == 1 ? inputName : inputName + "[]";
      $(file.previewElement).append(
        `<input type="hidden" name="${fileName}" value="${file.xhr.responseText}" />`
      );
    });

    myDropzone.on("error", function (file, errorMessage, xhr) {
      $(file.previewElement).find(".progress").fadeOut();
      $(file.previewElement).find(".error").fadeIn();
      if (typeof errorMessage === "object") {
        $(file.previewElement)
          .find(".error")
          .text(errorMessage.errors?.file[0]);
      } else {
        $(file.previewElement).find(".error").text(errorMessage);
      }
    });

    myDropzone.on("maxfilesexceeded", function (file) {
      this.removeFile(file);
    });

    myDropzone.on("removedfile", function (file) {
      jqDom.find(".fileinput-button").fadeIn();
      if (file?.xhr) {
        deleteTemporaryFile(file.xhr);
      } else if (file?.uuid) {
        deleteFile(file.uuid);
      }
    });

    myDropzone.on("maxfilesreached", function (file) {
      jqDom.find(".fileinput-button").fadeOut();
    });

    myDropzone.on("resetFiles", function () {
      if (this.files.length != 0) {
        this.files.forEach((file) => {
          file.previewElement.remove();
        });
      }
      this.files.length = 0;
    });

    return myDropzone;
  };

  var initJsTemplates = function () {
    $('[data-control="dropzone"][type="file"]').each(function () {
      initUsingJsTemplate(this);
    });
  };

  var mockFile = function (elm, values) {
    let dz = Dropzone.forElement(elm);
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
    values.forEach(function (media) {
      let mockFile = {
        uuid: media.uuid,
        name: media.name,
        size: media.size,
        mimeType: media.mime_type,
        accepted: true,
      };

      dz.displayExistingFile(mockFile, media.url);
      let previewElementJq = $(mockFile.previewElement);

      if (!acceptMimeTypeImage.includes(media.mime_type)) {
        previewElementJq.find("[data-dz-thumbnail]").remove();
      }
      previewElementJq
        .find("[data-dz-download]")
        .attr("href", baseUrl + "/attachment/download/" + media.uuid);
      previewElementJq.addClass("dz-success");
      previewElementJq.addClass("dz-complete");
      previewElementJq.find(".progress").hide();
      dz.files.push(mockFile);
    });

    if (dz.options.maxFiles != null && dz.files.length >= dz.options.maxFiles) {
      $(elm).find(".fileinput-button").hide();
    }

    return dz;
  };

  var deleteTemporaryFile = function (xhr) {
    if (xhr.status == 422) {
      return;
    }
    $.post(`attachment/delete_temporary_file/${xhr.responseText}`);
  };

  var deleteFile = function (param) {
    let xhr = $.post(`attachment/delete/${param}`);
    xhr.done(function (data) {
      console.log(data);
    });
  };

  return {
    firstInit: function () {
      initJsTemplates();
    },
    initUsingJsTemplate: function (dom) {
      initUsingJsTemplate(dom);
    },
    mockFile: function (dom, values) {
      mockFile(dom, values);
    },
  };
})();

Dropzone.autoDiscover = false;

OJTDropzones.firstInit();
