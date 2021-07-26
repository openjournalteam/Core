"use strict";


// Class definition

window.OJTMenu = function () {
  // Private functions
  var initSortable = function (el) {
    var url = el.getAttribute("url");
    var sortable = new Sortable(el, {
      animation: 150,
      ghostClass: 'active',
      // chosenClass: "bg-secondary",
      onUpdate: function (evt) {
        let list = sortable.toArray();

        updateUrutan(list, url)
      },
    });
  }


  var updateUrutan = function (list, url) {
    $.ajax({
      type: "POST",
      url: url,
      data: {
        ids: list,
      },
      success: function (response) {
        refresh();
        Toast.fire({
          icon: 'success',
          title: response.message,
        })
      },
    });
  }

  var addModalEventListener = function () {
    var modalFormMenu = document.getElementById('modal-form-menu');
    modalFormMenu.addEventListener('hidden.bs.modal', function (event) {
      $('input[name="order"]').val('');
    })
  }

  var refresh = function () {
    if (typeof Livewire !== 'undefined') {
      Livewire.emit('refreshMenu');
    }
  }

  return {
    // public functions
    init: function () {
      addModalEventListener();
      this.initSortable()
    },
    refresh: function () {
      refresh()
    },
    initSortable: function () {
      var sortables = document.getElementsByClassName("sortable-menu");
      for (let sort of sortables) {
        initSortable(sort);
      }
    }
  };
}();


if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
  module.exports = OJTMenu;
}

$(function () {
  OJTMenu.init()
});

function refreshMenu() {
  if (typeof Livewire !== 'undefined') {
    Livewire.emit('refreshMenu');
  }
}
