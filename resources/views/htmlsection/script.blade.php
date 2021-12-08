<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $('#uploadedPicture').attr('src', e.target.result).height(200);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }

function requestSuccess(){
  Swal.fire({
    icon: 'success',
    title: 'Success',
    showDenyButton: false,
    showCancelButton: false,
    confirmButtonText: 'Ok',
  }).then((result) => {
    location.reload();
  })
}

function showError(data){
  var txt = "";

  if(data.status == 422){
    var errors = data.responseJSON.errors;
    txt += "<ul style='text-align: left;'>";
    for(const field in errors){
      errors[field].forEach(element => {
        txt += "<li>" + element + "</li>"
      });
    }
    txt += "</ul>";
  }else if(data.status == 401){
    txt = "Login First";
  }else if(data.status == 403){
    txt = "You dont have permission to access. Ask Administrator";
  }else if(data.status == 400){
    txt = "There is trouble in your requests";
  }else if(data.status == 404){
    txt = "Not Found";
  }else if(data.status >= 500){
    txt = "Server Error. Contact Administrator";
  }

  Swal.fire({
    icon: 'error',
    title: 'Failed',
    html: txt
  })
}
</script>