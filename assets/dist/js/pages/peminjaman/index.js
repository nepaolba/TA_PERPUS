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


