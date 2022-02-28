<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    /**
     * @setup
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->stringCalculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function given_no_adders_returns_0()
    {
        $result = $this->stringCalculator->add("");

        self::assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function given_one_adder_returns_itself()
    {
        $result = $this->stringCalculator->add("1");

        self::assertEquals("1", $result);
    }

    /**
     * @test
     */
    public function given_two_adders_returns_the_sum()
    {
        $result = $this->stringCalculator->add("2.2,2");

        self::assertEquals("4.2", $result);
    }

    /**
     * @test
     */
    public function given_multiple_adders_returns_the_sum()
    {
        $result = $this->stringCalculator->add("2.2,2,1.1");

        self::assertEquals("5.3", $result);
    }

    /**
     * @test
     */
    public function given_multiple_adders_allowing_new_line_as_separator_returns_the_sum()
    {
        $result = $this->stringCalculator->add("2.2\n2,1.1");

        self::assertEquals("5.3", $result);
    }

    /**
     * @test
     */
    public function given_two_consecutive_separators_returns_an_error()
    {
        $result = $this->stringCalculator->add("175.2,\n35");

        self::assertEquals("Number expected but '\n' found at position 6.", $result);
    }

    /**
     * @test
     */
    public function given_no_adder_at_end_position_returns_an_error()
    {
        $result = $this->stringCalculator->add("1,3,2.3\n");

        self::assertEquals("Number expected but EOF found.", $result);
    }

    /**
     * @test
     */
    public function given_multiple_adders_with_a_change_of_separator_returns_the_sum()
    {
        $result = $this->stringCalculator->add("//aep\n1aep3aep2.3");

        self::assertEquals("6.3", $result);
    }

}
