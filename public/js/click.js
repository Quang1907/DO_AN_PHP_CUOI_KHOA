

var login = false;
var register = false;

// close modal login
$("#close-login").click(function () {
    if (login) {
        $("#authentication-modal-login").addClass("hidden");
        $("#authentication-modal-login").removeClass("block");
        login = false;
    }
});
// open modal login
$("#model-toggle-login").click(function () {
    if (!login) {
        $("#authentication-modal-login").addClass("block");
        $("#authentication-modal-login").removeClass("hidden");
        login = true;
    }
    register = false;
});
// close modal register
$("#close-register").click(function () {
    if (register) {
        $("#authentication-modal-register").addClass("hidden");
        $("#authentication-modal-register").removeClass("block");
        $("#authentication-modal-login").addClass("hidden");
        register = false;
    }
    login = false;
});
// open modal register
$("#model-toggle-register").click(function () {
    if (!register) {
        $("#authentication-modal-register").addClass("block");
        $("#authentication-modal-register").removeClass("hidden");
        register = true;
    }
});

$(".model-toggle-login").click(function () {
    $("#authentication-modal-register").addClass("hidden");
    register = false;
});

var company = false;
$("#mega-menu-full-dropdown-button").click(function () {
    if (company) {
        $("#mega-menu-full-dropdown").addClass("hidden");
        $("#mega-menu-full-dropdown").removeClass("block");
        company = false;
    } else {
        $("#mega-menu-full-dropdown").addClass("block");
        $("#mega-menu-full-dropdown").removeClass("hidden");
        company = true;
    }
});

