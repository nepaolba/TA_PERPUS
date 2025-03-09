$("#peminjaman").DataTable({	
	ordering: false,
	autoWidth: true,   
    language: {
        search: ""
    },
});
$('.dataTables_filter input')
.attr('placeholder', 'Cari Data Peminjaman...')
    .css({
        'width': '700px',
        'border': '2px solid rgba(0, 172, 214, 0.35)',
        'border-radius': '10px'
    })
    .removeClass('input-sm')
    .addClass('input-lg');


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
