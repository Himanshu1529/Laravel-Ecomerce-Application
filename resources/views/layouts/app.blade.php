<!DOCTYPE html>
<html lang="en">


<!-- molla/index-2.html  22 Nov 2019 09:55:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ !empty($meta_title) ? $meta_title : ''}}</title>

    @if(!empty($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif


    @if(!empty($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif

    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('client/images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('client/images/icons/favicon-16x16.png')}}">
    
    <link rel="shortcut icon" href="{{ url('client/images/icons/favicon.ico')}}">
    
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ url('client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ url('client/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ url('client/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ url('client/css/plugins/nouislider/nouislider.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ url('client/css/style.css')}}">
    @yield('style')
</head>

<body>
    <div class="page-wrapper">

        @include('layouts._header')

        @yield('content')

        @include('layouts._footer')

    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

        @include('layouts._mobile')

    

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#" id="SubmitFormRegister" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="register-name">Name*</label>
                                            <input type="text" class="form-control" id="register-name" name="name" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-email">Your Email Address *</label>
                                            <input type="email" class="form-control" id="register-email" name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <!-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ url('client/images/popup/newsletter/logo.png')}}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div>
                                </div>
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ url('client/images/popup/newsletter/img-1.jpg')}}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- Plugins JS File -->
    <script src="{{ url('client/js/jquery.min.js')}}"></script>
    <script src="{{ url('client/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url('client/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{ url('client/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ url('client/js/superfish.min.js')}}"></script>
    <script src="{{ url('client/js/owl.carousel.min.js')}}"></script>
    <script src="{{ url('client/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{ url('client/js/main.js')}}"></script>
    @yield('script')

    <script src="{{ url('client/js/wNumb.js')}}"></script>
    <script src="{{ url('client/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ url('client/js/nouislider.min.js')}}"></script>
    <!-- Main JS File -->
    <script>
        $('body').delegate('#SubmitFormRegister', 'submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('auth_register') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                    location.reload();
                    // if(data.success == true) { // Ensure using strict equality
                    //     location.reload();
                    // }
                },
                error: function(data) {
                    // handle error
                }
            });
        });
    </script>
</html>