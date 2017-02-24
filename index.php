<?php
if (extension_loaded('pdo_sqlite')) {
    require_once('app.php');
    $app=new App();
    $app->run();
} else {
    echo '<h1>PDO extension or SQLite PRO driver not loaded.</h1>';
}
