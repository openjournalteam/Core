document.addEventListener("alpine:init", () => {
  Alpine.data("plugin", (name, enabled) => ({
    open: false,
    name: name,
    enabled: enabled,
    init() {
      this.$watch("enabled", (value) => this.toggleEnable());
    },
    toggleOpen() {
      this.open = !this.open;
    },
    toggleEnable() {
      let xhr = $.post(adminUrl + "/list-plugins/toggle", {
        name: this.name,
        enable: this.enabled,
      });

      xhr.done(function (response) {
        if (response?.data.msg) {
          Toast.fire({
            icon: response?.success ? "success" : "error",
            title: response.data.msg,
          });
        }
      });
    },
    deletePlugin() {
      Swal.fire({
        title: `Are you sure want to delete ${this.name} plugin?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          let xhr = $.post(adminUrl + "/list-plugins/delete", {
            name: this.name,
          });

          xhr.done((response) => {
            if (response?.data.msg) {
              Toast.fire({
                icon: response?.success ? "success" : "error",
                title: response.data.msg,
              });
            }
            $(`#plugin${this.name}`).remove();
          });
        }
      });
    },
    migratePlugin() {
      let xhr = $.post(adminUrl + "/list-plugins/migrate", {
        name: this.name,
      });

      xhr.done((response) => {
        if (response?.data.msg) {
          Toast.fire({
            icon: response?.success ? "success" : "error",
            title: response.data.msg,
          });
        }
      });
    },
  }));
});
