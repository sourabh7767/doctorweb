$(document).on('click', '.delete-datatable-record', function(e){
    let url  = site_url + "/admin/users/" + $(this).attr('data-id');
    let tableId = 'usersTable';
    deleteDataTableRecord(url, tableId);
});

$(document).ready(function() {
    console.log(site_url, '======site_url');
    $('#usersTable').DataTable({
        ...defaultDatatableSettings,
        ajax: site_url + "/admin/users/",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'email', name: 'email' },
            // { data: 'user_role', name: 'user_role' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at'},
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});