<!DOCTYPE html>
<html lang="th">

<?php echo View::make('layouts.head') ?>      

<body data-spy="scroll">
    @if(isset($page))
    <?php echo View::make('layouts.menubar', compact('page')) ?>      
    @else
    <?php echo View::make('layouts.menubar') ?>      
    @endif
    
    @yield('main')
    
    <?php echo View::make('layouts.footer') ?>   

    <?php echo View::make('layouts.script') ?>  
</body>

</html>
