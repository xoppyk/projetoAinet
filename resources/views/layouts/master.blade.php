<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Projeto Ainet</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/dashboard.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    {{-- Date Picker --}}
    <link href="/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="/js/bootstrap-datepicker.min.js"></script>

  </head>
  <body>

  @include('partials.nav')

    <div class="container-fluid">
      <div class="row">

        @include('partials.leftNavBar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <br>
            @if(Session::has('type'))
                @alert(['type' => session('type'), 'message' => session('message')]) @endalert
            @endif
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

            <div class="container">
                <h1 class="h2">@yield('title')</h1>
                <hr>
                @yield('content')
            </div>
        </main>
      </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    {{-- Chart --}}
    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>

  </body>
</html>
