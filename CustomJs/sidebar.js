window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

var links = document.getElementsByClassName("admin-panel-nav-item");
var URL = window.location.pathname;
URL = URL.substring(URL.lastIndexOf('/'));
for (var i = 0; i < links.length; i++) {
    console.log(links[i].dataset.pathname);
      console.log(URL)
  if (links[i].dataset.pathname == URL) {
      console.log(links[i].dataset.pathname);
      console.log(URL)

    links[i].classList.add("nav-current-page");
  }
}