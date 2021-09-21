"use strict";
// Class definition

var OJTDatatables = (function () {
  var data = [];
  // Private functions
  var initDatatable = function (dom, data) {
    if (!dom) return;

    if (!(dom instanceof jQuery)) {
      dom = $(dom);
    }

    let ajax = data?.ajax ?? dom.data("ajax");

    if (!ajax) return dom.dataTable();

    let columns = data?.columns ?? [];

    let ths = dom.find("thead").find("tr").children();

    if (columns.length === 0) {
      ths.each(function () {
        let dom = $(this);
        let column = {};

        if (dom.data("data")) column.data = dom.data("data");
        if (dom.data("name")) column.name = dom.data("name");
        if (dom.data("class")) column.className = dom.data("class");
        if (dom.data("orderable")) column.orderable = dom.data("orderable");
        if (dom.data("searchable")) column.searchable = dom.data("searchable");

        columns.push(column);
      });
    }

    return dom.DataTable({
      processing: true,
      serverSide: true,
      ajax: ajax,
      columns: columns,
      responsive: true,
      autowidth: false,
      // language: {
      //   processing: `<div class="progress progress-sm">
      //   <div class="progress-bar progress-bar-indeterminate"></div>
      // </div>`,
      // }
    });
  };

  var initDatatables = function () {
    $(".datatables").each(function () {
      data.push(initDatatable(this));
    });
  };

  var recalculateOnChangeNavTab = function () {
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
      $($.fn.dataTable.tables(true))
        .DataTable()
        .columns.adjust()
        .responsive.recalc();
    });
  };

  return {
    init: function () {
      initDatatables();
      recalculateOnChangeNavTab();
    },
    initDatatable: function (jQ, data) {
      initDatatable(jQ, data);
    },
    reload: function () {
      data.forEach(function (datatable) {
        datatable.ajax.reload(null, false);
      });
    },
    recalc: function () {
      data.forEach(function (datatable) {
        datatable.columns.adjust().responsive.recalc();
      });
    },
    redraw: function () {
      data.forEach(function (datatable) {
        datatable.draw();
      });
    },
    data: data,
  };
})();

if (typeof module !== "undefined" && typeof module.exports !== "undefined") {
  module.exports = OJTDatatables;
}

$(function () {
  OJTDatatables.init();
});
