<!DOCTYPE html>
<html lang="th">

<?php echo View::make('layouts.head') ?>      

<body data-spy="scroll">
    <div id="main-wrapper">
       
        @yield('main')
    </div>

    <?php echo View::make('layouts.script') ?>  
</body>

</html>
