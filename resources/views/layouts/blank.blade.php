<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdtimepicker.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>برنامج ادارة المنتجات - @yield('title')</title>
    @yield('styles')
</head>

<body>
    <div class="container">
        @include('layouts.navbar')
        <div class="bg-dark p-2 text-white d-flex justify-content-between d-print-none"
            style="border-top: 1px solid #ccc">
            <div class="mt-1">
                مرحباً <b class="text-warning">{{auth()->user()->name}} </b>
            </div>

            <a class="btn btn-danger " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                تسجيل الخروج
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="bg-light p-2 d-print-none">
            <h3>@yield('title')</h3>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                    @yield('links')
                </ol>
            </nav>
          
        </div>
  <hr>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
        </div>
        @endif
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/mdtimepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script>
        $('.timepicker').mdtimepicker({
            timeFormat: 'hh:mm:ss.000',
            // format of the input value
            format: 'hh:mm tt',
            // readonly mode
            readOnly: false,
            // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
            hourPadding: false,
            // theme of the timepicker
            // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
            theme: 'dark',
            okLabel: 'تأكيد',
            cancelLabel: 'إغلاق',
        });

    </script>
    @yield('scripts')
</body>

</html>
