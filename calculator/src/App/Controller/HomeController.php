<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Request;
use App\Http\Response;
use App\View\View;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request): Response
    {

        return new Response($this->render('form.tpl', [
            '{title}' => 'Calculator',
            '{a}' => '',
            '{b}' => '',
            '{result}' => '',
            ]));
    }

}
