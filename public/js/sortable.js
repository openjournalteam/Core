"use strict";
// Class definition

var OJTSortable = function () {
  // Private functions
  var initSortable = function (el) {
    console.log(Sortable);
    if (typeof Sortable == 'undefined') {
      return;
    }

    return Sortable.create(el);
  }

  var initSortables = function () {
    var sortables = document.getElementsByClassName("sortable");
    console.log(sortables);
    for (let sort of sortables) {
      initSortable(sort);
    }
  }

  return {
    // public functions
    init: function () {
      initSortables();
    }
  };
}();


if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = OJTSortable;
}

$(function () {
  OJTSortable.init()
});