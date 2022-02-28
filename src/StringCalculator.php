<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{

    public function add(string $inputString): string
    {
        if($inputString != "")
        {
            if(($errorMessage = $this->errorDetection($inputString)) == "")
            {
                $inputString = str_replace("\n", ",", $inputString);

                $adders = explode(",", $inputString);
                $sum = 0;

                foreach ($adders as $adder)
                    $sum += $adder;

                return strval($sum);
            }

            return $errorMessage;
        }

        return "0";
    }

    private function errorDetection(string $inputString): string
    {
        $errorMessage = "";

        for($position = 1; $position < strlen($inputString); $position++)
        {
            $isSeparatorCurrentPosition = ($inputString[$position] == ",") || ($inputString[$position] == "\n");
            $isSeparatorPreviousPosition = ($inputString[$position - 1] == ",") || ($inputString[$position - 1] == "\n");

            if($isSeparatorCurrentPosition && $isSeparatorPreviousPosition)
                $errorMessage .= "Number expected but '" . $inputString[$position] . "' found at position " . $position . ".";
        }

        $isSeparatorLastPosition = ($inputString[strlen($inputString) - 1] == ",") || ($inputString[strlen($inputString) - 1] == "\n");
        if($isSeparatorLastPosition)
            $errorMessage .= "Number expected but EOF found.";

        return $errorMessage;
    }

}