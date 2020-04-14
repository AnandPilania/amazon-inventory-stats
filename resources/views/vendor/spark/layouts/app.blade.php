<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'
          type='text/css'>

    <style>
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url({{ asset('css/fonts/glyphicons-halflings-regular.ttf') }});
        }
    </style>
    <!-- CSS -->
    <link href="{{ mix(Spark::usesRightToLeftTheme() ? 'css/app-rtl.css' : 'css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
@stack('scripts')

<!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(Spark::scriptVariables(), [])); ?>;
    </script>
</head>
<body>
<div id="spark-app" v-cloak>
    <!-- Navigation -->
@if (Auth::check())
    @include('spark::nav.user')
@else
    @include('spark::nav.guest')
@endif

<!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Application Level Modals -->
    @if (Auth::check())
        @include('spark::modals.notifications')
        @include('spark::modals.support')
        @include('spark::modals.session-expired')
    @endif
</div>

<!-- JavaScript -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('/js/sweetalert.min.js') }}"></script>

{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" integrity="sha256-y/nn1YJAT/GwVsHZTooNErdWLjZvqMFJxNRLvigMD4I=" crossorigin="anonymous" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />--}}

<link rel="stylesheet" type="text/css"
      href="{{asset('bootstrap-datetimepicker/css/bootstrap-datetimepicker-standalone.css')}}">
<script type="text/javascript"
        src="{{asset('bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
</body>
</html>
