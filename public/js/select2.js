"use strict";

var OJTSelect2 = function () {

  var init = function (dom) {
    if (!(dom instanceof jQuery)) {
      dom = $(dom);
    }

    var options = {
      theme: dom.data('theme') ?? "bootstrap-5",
      width: dom.data('width') ?? 'resolve',
      selectionCssClass: "form-control",
      dropdownCssClass: "select2--small",
    };

    return dom.select2(options)
  };

  var inits = function () {
    $('select[data-control="select2"]').each(function () {
      init(this)
    });
  }


  return {
    //main function
    init: function () {
      inits();
    }
  }
}();

OJTSelect2.init();