<?php
require 'vendor/autoload.php';

use Authentication\PasswordHasher\DefaultPasswordHasher;

$hash = (new DefaultPasswordHasher())->hash('1234');
echo $hash . PHP_EOL;
