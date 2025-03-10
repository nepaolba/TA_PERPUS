const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});
const flash = $("#flash").data("flash");
const flashClass = $("#flash").data("class");
flash
    ? flashClass == "error"
        ? notif(flash, flashClass)
        : notif(flash, flashClass)
    : "";

function notif(Fnotif, Fclass) {
    Swal.fire({
        title: Fclass.toUpperCase(),
        text: Fnotif,
        icon: Fclass
      });
}
