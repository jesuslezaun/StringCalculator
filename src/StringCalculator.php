<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{

    public function add(string $adders): string
    {
        if($adders != "")
        {
            return $adders;
        }
        return "0";
    }

}