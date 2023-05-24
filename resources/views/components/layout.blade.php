<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Bevande_arlecchine.it'}}</title>

    <!-- LINK FILE CSS e JS-->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js',])
    
</head>
    <body>

        <!-- riferimento alla NAVBAR -->
        <x-nav/>

        <!-- riferimento al LAYOUT -->
        <div> 
            {{$slot}} 
        </div>

        <!-- riferimento al FOOTER -->
        <x-footer/>
        
    </body>
</html>