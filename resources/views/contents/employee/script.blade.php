<!-- DataTables  & Plugins -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                { data: "full_name" },
                { data: "company_name" },
                { data: "email" },
                { data: "phone" },
                { data: "action" },
            ],
        });

        $('form#employeeForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ url('/employees') }}";

            if($("#employeeId").val()){
                formData.append('_method', 'patch');  
                url = url + "/" + $("#employeeId").val();
            }

            $.ajax({
                url: url,
                type: 'POST',           
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result)
                {
                    requestSuccess();
                },
                error: function(data)
                {
                    showError(data);
                }
            });
        });
    });

    function showCreateModal(){
        $("#employeeInputFirstName").val("");
        $("#employeeInputLastName").val("");
        $("#employeeInputEmail").val("");
        $("#employeeInputPhone").val("");
        $("#employeeInputCompany").val("");
        $("#employeeId").val("");
        $('#employee-modal-lg').modal('show');
    }

    function showEditModal(id){
        var url = "{{ url('/employees') }}/";
        $.ajax({
            url: url + id,
            success: function(data)
            {
                $("#employeeInputFirstName").val(data.firstname);
                $("#employeeInputLastName").val(data.lastname);
                $("#employeeInputEmail").val(data.email);
                $("#employeeInputPhone").val(data.phone);
                $("#employeeInputCompany").val(data.company_id);
                $("#employeeId").val(data.id);
            },
            error: function(data)
            {
                showError(data);
            }
        });
        $('#employee-modal-lg').modal('show');
    }

    function deleteData(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ url('/employees') }}/";
                $.ajax({
                    url: url + id,
                    type: "DELETE",
                    success: function(data)
                    {
                        requestSuccess();
                    },
                    error: function(data)
                    {
                        showError(data);
                    }
                });
            }
        });
    }
</script>