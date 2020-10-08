<?php

declare(strict_types=1);


namespace App;

/**
 * Class Autoloader
 * @package App
 */
class Autoloader
{
    /**
     * @var string
     */
    private string $sourceDirectory;

    /**
     * Autoloader constructor.
     * @param string $sourceDirectory
     */
    public function __construct(string $sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
    }

    /**
     * @return void
     */
     public function registerAutoloader(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }
    /**
     * @param string $className
     * @return bool
     */
    private function loadClass(string $className): bool
    {
        $path = $this->sourceDirectory . DIRECTORY_SEPARATOR . $this->convertNamespaceToFilePath($className);

        if ($this->isFileReady($path)) {
            include($path);
            return true;
        }

        return false;
    }

    /**
     * @param string $namespace
     * @return string
     */
    private function convertNamespaceToFilePath(string $namespace) : string
    {
        return str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . '.php';
    }

    /**
     * @param string $path
     * @return bool
     */
    private function isFileReady(string $path): bool
    {
        return file_exists($path) && is_readable($path);
    }
}