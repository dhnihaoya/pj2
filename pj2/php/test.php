<!DOCTYPE html>
<html>
<body>

<?php
require ("../config.php");
require ("hotPicBar.php");

    $a = getTable();
    print_r($a);
    krsort($a);
    print_r($a);
    echo $a[0];
?>

</body>
</html>
