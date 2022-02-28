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

    /**
     * @test
     */
    public function given_one_adder_returns_itself()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1");

        self::assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function given_two_adders_returns_the_sum()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("2.2,2");

        self::assertEquals("4.2", $result);
    }

}
