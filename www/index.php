<?php

require_once __DIR__ . '/../Autoload.php';

Cat\Services\GenerateCache::generate();
Framework\App::launch();


var_dump(__FILE__);