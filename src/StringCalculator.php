<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{

    public function add(string $inputString): string
    {
        if($inputString != "")
        {
            $inputString = str_replace("\n", ",", $inputString);

            $adders = explode(",", $inputString);
            $sum = 0;

            foreach ($adders as $adder)
                $sum += $adder;

            return strval($sum);
        }

        return "0";
    }

}