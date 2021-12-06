<div class="modal fade" id="employee-modal-lg">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <form id="employeeForm" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <h4 class="modal-title">{{__('form.employee_label_title_edit')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="id" class="form-control" id="employeeId" required>
                            </div>
                            <div class="form-group" id="logoPicture">
                            </div>
                            <div class="form-group">
                                <label for="employeeInputFirstName">{{__('form.employee_label_first_name')}}</label>
                                <input type="text" name="firstname" class="form-control" id="employeeInputFirstName">
                            </div>
                            <div class="form-group">
                                <label for="employeeInputLastName">{{__('form.employee_label_last_name')}}</label>
                                <input type="text" name="lastname" class="form-control" id="employeeInputLastName">
                            </div>
                            <div class="form-group">
                                <label for="employeeInputEmail">{{__('form.employee_label_email')}}</label>
                                <input type="email" name="email" class="form-control" id="employeeInputEmail">
                            </div>
                            <div class="form-group">
                                <label for="employeeInputPhone">{{__('form.employee_label_phone')}}</label>
                                <input type="text" name="phone" class="form-control" id="employeeInputPhone">
                            </div>
                            <div class="form-group">
                                <label>{{__('form.employee_label_company')}}</label>
                                <select class="form-control select2" style="width: 100%;" name="company_id">
                                    <option value="-">no company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onClick="$('#employee-modal-lg').hide();">{{__('form.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('form.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>