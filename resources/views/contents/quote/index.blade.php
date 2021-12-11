@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{__('table.quote_label_title')}}</h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#" data-toggle="tab" id="refreshQuotes">Refresh Quotes</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <table id="quoteTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>{{__('table.label_index')}}</th>
                          <th>{{__('table.quote_label_text')}}</th>
                          <th>{{__('table.quote_label_author')}}</th>
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
</section>
@endsection
<!-- /.login-box -->

@section('customscript')
    @include('contents.quote.script')
@endsection