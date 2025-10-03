document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.getElementById("sidebar");
      const sidebarToggle = document.getElementById("sidebarToggle");
      const sidebarClose = document.getElementById("sidebarClose");
      const mainWrapper = document.getElementById("mainWrapper");
      const overlay = document.getElementById("overlay");

      if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function(e) {
          e.preventDefault();
          sidebar.classList.toggle("show");
          mainWrapper.classList.toggle("shifted");
          overlay.classList.toggle("active");
        });
      }

      if (sidebarClose) {
        sidebarClose.addEventListener("click", function(e) {
          e.preventDefault();
          sidebar.classList.remove("show");
          mainWrapper.classList.remove("shifted");
          overlay.classList.remove("active");
        });
      }

      if (overlay) {
        overlay.addEventListener("click", function() {
          sidebar.classList.remove("show");
          mainWrapper.classList.remove("shifted");
          overlay.classList.remove("active");
        });
      }
    });