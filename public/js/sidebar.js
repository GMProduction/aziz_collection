var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
menu_btn.addEventListener("click", () => {
  sidebar.classList.toggle("active-nav");
  container.classList.toggle("active-cont");
});

var url = window.location.pathname.split('/');
var lok2 = url[2];
var lok1 = url[1];
var lok3 = url[3];

$(document).ready(function () {
    setActive()
})

function setActive() {

    console.log(lok2);
    console.log(lok3);
    if (lok2 === undefined || lok2 === '') {
        $('#sidebar #dashboard').addClass('setActive');
    } else {
        $('#sidebar #' + lok2).addClass('setActive');
    }
    if (lok3) {
        $('#sub-' + lok2).collapse();
        $('#sub-' + lok2 + ' #' + lok3).css('color', 'var(--blueColor)')
        $('#drop-'+ lok2+' #'+lok3).addClass('active');

    }

}
