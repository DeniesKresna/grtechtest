@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{__('table.employee_label_title')}}</h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#" data-toggle="tab" onClick="showCreateModal()">{{__('form.create')}}</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <!-- advanced filter -->
                  <div class="row">
                    <div class="col-1">
                      <p><strong>Advanced Filter</strong></p>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control float-right change-filter" id="creationDateFilter" placeholder="creation time">
                    </div>
                    <div class="col-2">
                      <input type="text" id="emailFilter" class="form-control keyup-filter" placeholder="Email">
                    </div>
                    <div class="col-2">
                      <input type="text" id="firstnameFilter" class="form-control keyup-filter" placeholder="First Name">
                    </div>
                    <div class="col-2">
                      <input type="text" id="lastnameFilter" class="form-control keyup-filter" placeholder="Last Name">
                    </div>
                    <div class="col-2">
                      <select class="form-control select2 change-filter" id="companyIdFilter">
                          <option value="">no filter</option>
                          @foreach ($companies as $company)
                              <option value="{{$company->id}}">{{$company->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <table id="employeeTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>{{__('table.label_index')}}</th>
                          <th>{{__('table.employee_label_full_name')}}</th>
                          <th>{{__('table.employee_label_company')}}</th>
                          <th>{{__('table.employee_label_email')}}</th>
                          <th>{{__('table.employee_label_phone')}}</th>
                          <th>{{__('table.label_action')}}</th>
                        </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
      </div>
    </div>
    @include('contents.employee.modal')
</section>
@endsection
<!-- /.login-box -->

@section('customscript')
    @include('contents.employee.script')
@endsection