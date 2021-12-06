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
        $('#companyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('company.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                { data: "name" },
                { data: "email" },
                { data: "renderedLogo" },
                { data: "website" },
                { data: "action" },
            ],
        });

        $('form#companyForm').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            var url = "{{ url('/company') }}";

            if($("#companyId").val()){
                formData.append('_method', 'patch');  
                url = url + "/" + $("#companyId").val();
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
                    if(data.status == 422)
                        alert(data.responseJSON.message);
                    if(data.status == 404)
                        alert("url not found");
                }
            });
        });
    });

    function showCreateModal(){
        $("#companyInputName").val("");
        $("#companyInputEmail").val("");
        $("#companyInputWebsite").val("");
        $("#companyId").val("");
        $("#logoPicture").html("");
        $('#company-modal-lg').modal('show');
    }

    function showEditModal(id){
        $("#logoPicture").html("");
        var url = "{{ url('/company') }}/";
        $.ajax({
            url: url + id,
            success: function(data)
            {
                $("#companyInputName").val(data.name);
                $("#companyInputEmail").val(data.email);
                $("#companyInputWebsite").val(data.website);
                $("#companyId").val(data.id);
                if(data.logo == "" || data.logo == null){
                }else{
                    var logoUrl = "{{ asset('/storage/company') }}";
                    $("#logoPicture").prepend('<img src="' + logoUrl +'/' +data.logo + '"  width="200px" />');
                }
            },
            error: function(data)
            {
                alert(data.responseJSON.message);
            }
        });
        $('#company-modal-lg').modal('show');
    }

    function deleteData(id){
        if(confirm("delete this company?")){
            var url = "{{ url('/company') }}/";
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