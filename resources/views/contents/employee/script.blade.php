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
            ajax: "{{ route('employee.index') }}",
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
            var url = "{{ url('/employee') }}";

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
                    alert("success");
                    location.reload();
                },
                error: function(data)
                {
                    console.log(data);
                    if(data.status == 422)
                        alert(data.responseJSON.message);
                    if(data.status == 404)
                        alert("url not found");
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
        var url = "{{ url('/employee') }}/";
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
                alert(data.responseJSON.message);
            }
        });
        $('#employee-modal-lg').modal('show');
    }

    function deleteData(id){
        if(confirm("delete this employee?")){
            var url = "{{ url('/employee') }}/";
            $.ajax({
                url: url + id,
                type: "DELETE",
                success: function(data)
                {
                    alert("success");
                    location.reload();
                },
                error: function(data)
                {
                    if(data.status == 404)
                        alert("url not found");
                }
            });
        }
    }
</script>