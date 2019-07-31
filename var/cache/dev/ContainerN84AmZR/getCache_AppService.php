<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'cache.app' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/cache/PruneableInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/FilesystemCommonTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Traits/FilesystemTrait.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Adapter/FilesystemAdapter.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Marshaller/MarshallerInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/cache/Marshaller/DefaultMarshaller.php';

$this->services['cache.app'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('UqXICGC6rU', 0, ($this->targetDirs[0].'/pools'), new \Symfony\Component\Cache\Marshaller\DefaultMarshaller(NULL));

$instance->setLogger(($this->privates['logger'] ?? ($this->privates['logger'] = new \Symfony\Component\HttpKernel\Log\Logger())));

return $instance;
