<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController
{
    private string $templateDirectory;

    /**
     * HomeController constructor.
     * @param string $templateDirectory
     */
    public function __construct(string $templateDirectory)
    {
        $this->templateDirectory = $templateDirectory;
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function render(string $template, array $data = []): string
    {
        $view = new View($this->templateDirectory);

        return $view->render($template, $data);
    }
}