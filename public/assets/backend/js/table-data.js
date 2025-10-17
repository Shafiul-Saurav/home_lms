
"use strict";

$(function (e) {

	// Basic Data Table
	$('#basic-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	// Basic Data Table
	$('#responsive-datatable').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});

	// File-Export Data Table
	var table = $('#file-datatable').DataTable({
		buttons: ['copy', 'excel', 'pdf', 'colvis'],
		responsive: true,
		order: [[6, 'desc']], // Sort by the Date column (0-indexed, so 6 is the 7th column) in descending order
		columnDefs: [
			{ type: 'date', targets: 6 } // Specify column 6 as date type for proper sorting
		],
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});
	table.buttons().container()
		.appendTo('#file-datatable_wrapper .col-md-6:eq(0)');

	// Delete Data Table
	var table = $('#delete-datatable').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
		}
	});
	$('#delete-datatable tbody').on('click', 'tr', function () {
		if ($(this).hasClass('selected')) {
			$(this).removeClass('selected');
		}
		else {
			table.$('tr.selected').removeClass('selected');
			$(this).addClass('selected');
		}
	});
	$('#button').on("click", function () {
		table.row('.selected').remove().draw(false);
	});

	$('#example3').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
    $('#example2').DataTable({
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});

	// Select2 
	$('.select2').select2({
		minimumResultsForSearch: Infinity
	});


});