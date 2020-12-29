<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
        <title>GesStock</title>
        
        <link href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
        
    </head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
            @include('partials.sidebar')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('partials.nav')

                <!--begin nav -->
                    @include('flash-message')
                    @yield('content')
                 <!--end nav -->
                    
                </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <strong>Copyright &copy; {{date('Y')}} <a href="#">OPTIMIS</a>.</strong> Tous droits réservés.
          </div>
        </div>
 </footer>
      <!-- End of Footer -->

      </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 <script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('/js/sb-admin-2.js')}}"></script>
        <script src="{{asset('/vendor/toastr/toastr.js')}}"></script>
        <script src="{{asset('/vendor/sweetalert/sweetalert.min.js')}}">
        
        </script>
<script src="{{asset('/vendor/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('/vendor/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/vendor/input-mask/jquery.inputmask.extensions.js')}}"></script>
  <script>
            function date_time(id) {let date = new Date();let year = date.getFullYear();let month = date.getMonth();let months = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre');let d = date.getDate();let day = date.getDay();let days = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');let h = date.getHours();if(h<10) {h = "0"+h;}let m = date.getMinutes();if(m<10) {m = "0"+m;}let s = date.getSeconds();if(s<10){s = "0"+s;}let result = ''+days[day]+', '+d+' '+months[month]+' '+year+' / '+h+':'+m+':'+s;document.getElementById(id).innerHTML = result;setTimeout('date_time("'+id+'");','1000');return true;}
            date_time('date_time');
    </script>

  

</body>

</html>

