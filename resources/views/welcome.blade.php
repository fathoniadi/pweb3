<!DOCTYPE html>
<html>
    <head>
        <title>Aksi.in</title>

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
            }

            .content {
                display: inline-block;
            }

            .title {
                font-size: 90px;
                color: white;
                
            }
            input[type=text], input[type=email], input[type=password]{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;

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
              left: 33%;
            }


        </style>
    </head>
    <body>
        <div id="particles">
            <div id="intro" >
                <div class="container">
                    <div class="title" style="margin-bottom:30px">Comingsoon</div>
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
