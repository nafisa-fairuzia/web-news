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

    function updateNewsClock() {
  const el = document.getElementById('newsClock');
  if (!el) return;
  const now = new Date();
  let h = now.getHours();
  let m = now.getMinutes();
  let s = now.getSeconds();
  let ampm = h >= 12 ? 'PM' : 'AM';
  h = h % 12;
  h = h ? h : 12;
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  el.textContent = `${h}:${m}:${s} ${ampm}`;
}
setInterval(updateNewsClock, 1000);
document.addEventListener('DOMContentLoaded', updateNewsClock);