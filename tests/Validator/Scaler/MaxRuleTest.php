<?php

namespace SimpleTests\Test\TestCaseTest;

use Simple\Test\TestCase;
use Simple\Validator\Scaler\MaxRule;

final class MaxRuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\Scaler\MaxRule
     * @uses \Simple\Test\TestCase
     */
    public function does_not_throw_exception_when_value_is_lower_than_maximum()
    {
        $rule = new MaxRule(10);

        $rule->validate(5);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simple\Validator\Scaler\MaxRule
     * @uses \Simple\Test\TestCase
     */
    public function does_not_throw_exception_when_value_is_equal_to_maximum()
    {
        $rule = new MaxRule(10);

        $rule->validate(10);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simple\Validator\Scaler\MaxRule
     * @uses \Simple\Test\TestCase
     */
    public function throw_exception_when_value_is_greater_than_maximum()
    {
        $rule = new MaxRule(10);

        try {
            $rule->validate(11);
        } catch(\Throwable $e) {
            $this->assertEquals('Value must be lower than 15.', $e->getMessage(), 'Greater value than maximum not allowed.');
        }
    }

    /**
     * @test
     * @covers \Simple\Validator\Scaler\MaxRule
     * @uses \Simple\Test\TestCase
     */
    public function throw_exception_when_value_is_not_number()
    {
        $rule = new MaxRule(10);

        try {
            $rule->validate('aslami');
        } catch(\Throwable $e) {
            $this->assertEquals('Value should be number.', $e->getMessage(), 'None number value not allowed.');
        }
    }
}
