<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
       
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background-color: #7f8c8d;
            }

            #particles {
              width: 100%;
              height: 100%;
              overflow: hidden;
            }

            .container {
                text-align: center;
                border-radius: 10px;
                display: block;
                background-color: white;
                width: 400px;
                padding: 40px 20px;
            }

            .content {
                display: inline-block;
                width: 80%;
            }

            .title {
                font-size: 40px;
                
            }
            input[type=text], input[type=email], input[type=password]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;

            }
            input:focus{
                box-shadow: 0 0 5px rgba(81, 203, 238, 1);
                border: 1px solid rgba(81, 203, 238, 1);
            }
            input[type=submit] {
                background-color: #2980b9; /* Green */
                border: none;
                color: white;
                margin-top:10px;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
            }
            #intro {
              position: absolute;
              top: 50%;
              padding: 0;
              left: calc(50% - 200px);
              /*calc responsif(ukuran yang dimau - width child/2)*/
            }


        </style>
    </head>
    <body>
        <div id="particles">
            <div id="intro" >
                <div class="container">
                    <div class="title" style="margin-bottom:30px">@yield('title')</div>
                        <div class="content" style="text-align:left; color:black">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{url('/')}}/resources/assets/js/jquery.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/resources/assets/js/jquery.particleground.demo.js"></script>
    <script src="{{url('/')}}/resources/assets/js/jquery.particleground.js"></script>
    
</html>
