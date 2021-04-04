<?php

namespace SimpleTests\Test\TestCaseTest;

use Simple\Test\TestCase;
use Simple\Validator\Scaler\IntegerRule;

final class IntegerRuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\Scaler\IntegerRule
     * @uses \Simple\Test\TestCase
     */
    public function validate_int_return_do_not_throw_any_exception()
    {
        $rule = new IntegerRule();

        $rule->validate(10);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simple\Validator\Scaler\IntegerRule
     * @uses \Simple\Test\TestCase
     */
    public function validate_non_int_throw_exception_with_message()
    {
        $rule = new IntegerRule();

        try {
            $rule->validate('aslami');
        } catch(\Throwable $e) {
            $this->assertEquals('Value must be integer.', $e->getMessage(), 'IntegerRule accept string as integer not allowed.');
        }
    }
}
