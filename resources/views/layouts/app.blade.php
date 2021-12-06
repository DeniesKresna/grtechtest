<!DOCTYPE html>
<html lang="en">
<head>
  @include('htmlsection.header')
</head>
@guest
  <body class="hold-transition login-page">
      @yield('content')
@else
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      @include('htmlsection.navbar')
      @include('htmlsection.sidebar')
      <div class="content-wrapper">
        @include('htmlsection.content_header')

        @yield('content')'
        
        @include('htmlsection.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
      </div>
    </div>
@endguest

@include('htmlsection.script')
@yield('customscript')
</body>
</html>
