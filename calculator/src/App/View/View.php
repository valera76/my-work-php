<?php

declare(strict_types=1);

namespace App\View;

/**
 * Class View
 * @package App\View
 */
class View
{
    /**
     * @var string
     */
    private string $templateDirectory;

    /**
     * View constructor.
     * @param string $templateDirectory
     */
    public function __construct(string $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    /**
     * @param string $template
     * @param array $data
     *
     * @return string
     */
    public function render(string $template, array $data): string
    {
        $path = $this->templateDirectory . DIRECTORY_SEPARATOR . $template;

        if (!file_exists($path)) {
            throw new \Exception('Template' . $template. 'not found.');
        }

        return strtr(file_get_contents($path), $data);
    }
}