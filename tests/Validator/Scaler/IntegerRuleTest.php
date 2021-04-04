<?php

namespace SimpleTests\Validator\Scaler;

use Simple\Test\TestCase;
use Simple\Validator\Exceptions\OnlyIntegerAllowedException;
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

        $catched = false;
        try {
            $rule->validate('aslami');
        } catch(OnlyIntegerAllowedException $e) {
            $catched = true;
        }

        $this->assertTrue($catched, 'Exception does not thrown for non int value.');
    }
}
