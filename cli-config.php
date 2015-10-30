<?php

require_once __DIR__ . "/app/bootstrap.php";

$helperSet = new \Symfony\Component\Console\Helper\HelperSet([
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app['orm.em']->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app['orm.em'])
]);

return $helperSet;

/* End of cli-config.php file 

php vendor/doctrine/orm/bin/doctrine orm:schema-tool:update --force

php vendor/doctrine/orm/bin/doctrine orm:generate-entities app/src/ --update-entities=true

*/
