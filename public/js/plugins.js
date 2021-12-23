document.addEventListener("alpine:init", () => {
  Alpine.data("OJTPlugin", () => ({
    loading: false,
    backupIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
      <polyline points="7 11 12 16 17 11" />
      <line x1="12" y1="4" x2="12" y2="16" />
    </svg>`,
    init() {
      console.log("Alpine OJT Plugin initialized");
    },
    install(btn) {
      this.loading = true;
      let dom = $(btn),
        slug = dom.data("slug");

      if (!slug) {
        console.log("No slug found");
        return;
      }

      $.get(`${baseUrl}/list-plugins/install/${slug}`, (res) => {
        this.loading = false;
        if (res.success) {
          OJTApp.successNotification(res.message);
          return;
        }
        OJTApp.errorNotification(res.message);
      });
    },
  }));
});