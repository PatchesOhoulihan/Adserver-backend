<?php

require '../vendor/autoload.php';

$config = require '../setup/config.php';

$app = new \Slim\App($config);

require '../setup/dependencies.php';

require '../middleware/middleware.php';

// Register Startup Site, indicates that the service is running
require '../routes/monitoring.php';

//Register Customer Routes, do the desired work
require '../routes/customers.php';


$app->run();


