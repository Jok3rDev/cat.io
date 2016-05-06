<?php

require_once __DIR__ . '/../Autoload.php';

Framework\App::launch();

Cat\Services\GenerateCache::generate();