<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Bevande_arlecchine.it'}}</title>

    <!-- stili di livewire -->
    @livewireStyles

    <!-- LINK FONTOSO -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- LINK FILE CSS e JS-->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/bootstrap.js',])
    
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


    
        <!-- script di livewire -->
        @livewireScripts      
    </body>
</html>