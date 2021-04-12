<?php

namespace Tests\Validator\Contracts;

use Simple\Test\TestCase;
use Simple\Validator\Contracts\KeyValueRule;

class TestKeyValueRule extends KeyValueRule
{
    public function check($value)
    {
        //
    }
}

final class KeyValueRuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\Contracts\KeyValueRule
     */
    public function get_next_value_get_value_of_key()
    {
        $rule = new TestKeyValueRule('testKey');

        $this->assertEquals(10, $rule->getNextValue([
            'testKey' => 10
        ]));
    }
}
