"use strict";
// Class definition

var OJTSummernote = (function () {
  // Private functions and variables
  var summernote = function (jQ, options) {
    jQ.summernote(options);
  };

  var init = function () {
    // Summernote
    var $summernote = $('[data-control="summernote"]');
    if ($summernote.length) {
      $summernote.each(function () {
        var jQ = $(this);
        var options = {
          height: 150,
          toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "video"]],
            ["view", ["codeview"]],
            // ["mybutton", ["hello"]],
            ["help", ["help"]],
          ],
          // buttons: {
          //   hello: HelloButton,
          // },
        };
        if (jQ.data("height")) {
          options.height = jQ.data("height");
        }
        if (jQ.data("toolbar")) {
          options.toolbar = jQ.data("toolbar");
        }
        summernote(jQ, options);
      });
    }
  };

  var HelloButton = function (context) {
    var ui = $.summernote.ui;

    // create button
    var button = ui.button({
      contents: '<i class="fa fa-child"/> Hello',
      tooltip: "hello",
      container: context.layoutInfo.editor,
      click: function () {
        // invoke insertText method with 'hello' on editor module.
        context.invoke("editor.insertText", "hello");
      },
    });

    return button.render(); // return button as jquery object
  };

  return {
    init: function () {
      init();
    },
  };
})();

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
  module.exports = OJTSummernote;
}

$(function () {
  OJTSummernote.init();
});
