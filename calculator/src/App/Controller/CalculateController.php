<?php

declare(strict_types=1);

namespace App\Controller;

use App\DomainModel\Calculator;
use App\Http\Request;
use App\Http\Response;

/**
 * Class CalculateController
 * @package App\Controller
 */
 
class CalculateController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function calculate(Request $request): Response
    {
        $body = $request->getBody();

        $a = (int) $body['a'];
        $b = (int) $body['b'];
        $action = $body['operation'];

        $calculator = new Calculator($a, $b);

        if ($action === 'Sum') {
            $c = $calculator->sum();
        }

        if ($action === 'Sub') {
            $c = $calculator->sub();
        }

        if ($action === 'Div') {
            $c = $calculator->div();
        }

        if ($action === 'Mul') {
            $c = $calculator->mul();
        }

        return new Response($this->render('form.tpl', [
            '{title}' => 'Calculator',
            '{a}' => $a,
            '{b}' => $b,
            '{result}' => 'Result is ' . $c,
        ]));

    }
}
