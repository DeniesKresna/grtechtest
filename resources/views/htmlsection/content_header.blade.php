<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ isset($pageTitle)? $pageTitle:'Dashboard' }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">{{ isset($rootMenu)? $rootMenu:'Dashboard' }}</a></li>
            <li class="breadcrumb-item active">{{ isset($subMenu)? $subMenu:'' }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>