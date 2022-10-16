<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Website title - bootstrap html template</title>

    <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="{{ asset('css/ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- custom javascript -->
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>

</head>

<body>


    <header class="section-header">
        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <a href="{{url('/')}}"><strong>Home</strong></a> |
                    <a href="{{route('weather')}}"><strong>Weather</strong></a> | 
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"><strong>Dashboard</strong></a>

                </div> <!-- row.// -->
            </div> <!-- container.// -->
            
        </section> <!-- header-main .// -->

    </header> <!-- section-header.// -->



    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">

        <!-- ============================ COMPONENT REGISTER   ================================= -->
        <div class="card mx-auto" style="max-width:520px; margin-top:40px;">
              <article class="card-body">
                <h4 class="card-title mb-4">Weather</h4>

                <form action="{{ route('weatherapi') }}" method="get">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-12 form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control"placeholder="City" required>

             
                        </div> <!-- form-group end.// -->

                    </div> <!-- form-row.// -->

                    <button type="submit" class="btn btn-primary btn-block">Send</button>
                    <div style="text-align: center">
                        @if (isset($weather))
                        @php
                             echo $weather;
                        @endphp
                       
                        @endif
                        @if (isset($errorCity))
                        {{$errorCity}}
                        @endif
                    </div>
                </form>
              </article> <!-- card-body.// -->
        </div>
        <br><br>
        <!-- ============================ COMPONENT LOGIN  END.// ================================= -->


    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->




    <!-- ========================= FOOTER ========================= -->

    <!-- ========================= FOOTER END // ========================= -->


</body>

</html>
