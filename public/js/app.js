"use strict";
// Class definition

var OJTApp = function () {
  // Private functions
  var initAjaxLoad = function (dom) {
    let url = dom.attr('url');
    $.ajax({
      type: "get",
      url: url,
      beforeSend: function () {
        dom.html(`<div class="d-flex align-items-center">
        <strong>Loading...</strong>
        <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
      </div>`)
      },
      success: function (response) {
        dom.html(response);
      },
      error: function (ajax, textStatus, errorThrown) {
        dom.html('<div class="alert alert-warning"> Terjadi kesalahan silahkan hubungi Developer!!! </div>')
      },
    });
  }

  var initAjaxLoads = function () {
    $('.ajax_load').each(function () {
      initAjaxLoad($(this));
    });
  }

  return {
    // public functions
    init: function () {
      initAjaxLoads()
    },
    refreshAjaxLoad: function () {
      initAjaxLoads();
    },
    randomstring: function (L = 40) {
      var s = "";
      var randomchar = function () {
        var n = Math.floor(Math.random() * 62);
        if (n < 10) return n; //1-10
        if (n < 36) return String.fromCharCode(n + 55); //A-Z
        return String.fromCharCode(n + 61); //a-z
      };
      while (s.length < L) s += randomchar();
      return s;
    },
    generateToken: function (number = 20) {
      return this.randomstring(number);
    },
    hasJsonStructure: function (str) {
      if (typeof str !== 'string') return false;
      try {
        const result = JSON.parse(str);
        const type = Object.prototype.toString.call(result);
        return type === '[object Object]'
          || type === '[object Array]';
      } catch (err) {
        return false;
      }
    },
    safeJsonParse: function (str) {
      try {
        return [null, JSON.parse(str)];
      } catch (err) {
        return [err];
      }
    },
    successNotification: function (msg = 'Process is success') {
      Toast.fire({
        icon: 'success',
        title: msg,
      })
    },
    errorNotification: function (msg = 'Error encounter') {
      Toast.fire({
        icon: 'error',
        title: msg,
      })
    },
    infoNotification: function (msg) {
      Toast.fire({
        icon: 'info',
        title: msg,
      })
    }
  };
}();

$(function () {
  OJTApp.init()
});