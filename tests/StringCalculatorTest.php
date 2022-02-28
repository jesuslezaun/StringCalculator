<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{

    /**
     * @test
     */
    public function given_no_adders_returns_0()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("");

        self::assertEquals("0", $result);
    }

}
