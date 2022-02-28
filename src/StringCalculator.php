<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{

    public function add(string $inputString): string
    {
        if($inputString != "")
        {
            $separator = $this->extractSeparator($inputString);
            $isOriginalSeparator = $separator == ",";

            if(!$isOriginalSeparator)
                $inputString = substr($inputString, strpos($inputString, "\n") + 1);

            $errorMessage = $this->errorDetection($inputString, $separator);

            if($isOriginalSeparator)
                $inputString = str_replace("\n", $separator, $inputString);

            $adders = explode($separator, $inputString);
            $sum = 0;
            $negativeAdders = [];

            foreach ($adders as $adder)
            {
                if(is_numeric($adder))
                {
                    if($adder < 0)
                        $negativeAdders[] = $adder;

                    $sum += $adder;
                }
            }

            if($negativeAdders != [])
            {
                if($errorMessage != "")
                    $errorMessage .= "\n";
                $errorMessage .= "Negative not allowed : ";

                for($position = 0; $position < count($negativeAdders); $position++)
                {
                    if($position < count($negativeAdders) - 1)
                        $errorMessage .= $negativeAdders[$position] . ", ";
                    else
                        $errorMessage .= $negativeAdders[$position];
                }
            }

            if($errorMessage == "")
                return strval($sum);
            else
                return $errorMessage;
        }

        return "0";
    }

    private function errorDetection(string $inputString, string $separator): string
    {
        $errorMessage = "";

        $isOriginalSeparator = $separator == ",";

        for($position = 1; $position < strlen($inputString); $position++)
        {
            if(!$isOriginalSeparator && $inputString[$position] == ",")
            {
                if($errorMessage != "")
                    $errorMessage .= "\n";
                $errorMessage .= "'" . $separator . "' expected but ',' found at position " . $position . ".";
            }

            if($isOriginalSeparator)
            {
                $isSeparatorCurrentPosition = ($inputString[$position] == ",") || ($inputString[$position] == "\n");
                $isSeparatorPreviousPosition = ($inputString[$position - 1] == ",") || ($inputString[$position - 1] == "\n");
            }
            else
            {
                $isSeparatorCurrentPosition = ($inputString[$position] == $separator);
                $isSeparatorPreviousPosition = ($inputString[$position - 1] == $separator);
            }

            if($isSeparatorCurrentPosition && $isSeparatorPreviousPosition)
            {
                if($errorMessage != "")
                    $errorMessage .= "\n";
                $errorMessage .= "Number expected but '" . $inputString[$position] . "' found at position " . $position . ".";
            }

        }

        if($isOriginalSeparator)
            $isSeparatorLastPosition = ($inputString[strlen($inputString) - 1] == ",") || ($inputString[strlen($inputString) - 1] == "\n");
        else
            $isSeparatorLastPosition = ($inputString[strlen($inputString) - 1] == $separator);

        if($isSeparatorLastPosition)
        {
            if($errorMessage != "")
                $errorMessage .= "\n";
            $errorMessage .= "Number expected but EOF found.";
        }

        return $errorMessage;
    }

    private function extractSeparator(string $inputString): string
    {
        $separator = ",";

        if($inputString[0] == "/" && $inputString[1] == "/")
            $separator = substr($inputString, 2, strpos($inputString, "\n") - 2);

        return $separator;
    }

}