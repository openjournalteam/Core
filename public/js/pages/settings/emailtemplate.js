"use strict";
// Class definition

var OJTMailTemplate = (function () {
  // Private functions and variables

  var initSummernote = function () {
    $(".datatables").each(function () {
      data.push(initDatatable(this));
    });
  };

  return {
    init: function () {
      
    },
  };
})();

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
  module.exports = OJTMailTemplate;
}

$(function () {
  OJTMailTemplate.init();
});
