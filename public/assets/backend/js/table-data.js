
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

	// File-Export Data Table - Modified to work with any number of columns and handle serial numbers
	var table;
	if ($('#file-datatable').length) {
		// Get number of columns to determine appropriate settings
		var numColumns = $('#file-datatable thead th').length;
		
		var config = {
			buttons: ['copy', 'excel', 'pdf', 'colvis'],
			responsive: true,
			language: {
				searchPlaceholder: 'Search...',
				sSearch: '',
			},
			// Update serial numbers on draw (sort, search, page change)
			drawCallback: function() {
				var api = this.api();
				var startIndex = api.context[0]._iDisplayStart;
				
				// Update first column (index 0) which is assumed to be serial numbers
				api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
					$(cell).html(startIndex + i + 1);
				});
			}
		};
		
		// Only apply column-specific settings if table has enough columns
		if (numColumns > 6) {
			// Original configuration for tables with 7+ columns
			config.order = [[6, 'desc']]; // Sort by the 7th column in descending order
			config.columnDefs = [
				{ type: 'date', targets: 6 } // Specify column 6 as date type for proper sorting
			];
		} else if (numColumns > 1) {
			// For tables with fewer columns, sort by second column (index 1) if it exists
			config.order = [[1, 'desc']]; // Sort by the 2nd column in descending order
			config.columnDefs = [
				{ type: 'date', targets: 1 } // Specify column 1 as date type for proper sorting if it's a date column
			];
		} else if (numColumns == 1) {
			// For single column tables, no sorting by data
			config.order = [[0, 'asc']]; // Sort by the first column in ascending order
		}
		
		table = $('#file-datatable').DataTable(config);
		table.buttons().container()
			.appendTo('#file-datatable_wrapper .col-md-6:eq(0)');
	}

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