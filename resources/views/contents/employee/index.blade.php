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