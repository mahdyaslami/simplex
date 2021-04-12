<?php

namespace SimpleTests\Validator\Contracts;

use Simple\Test\TestCase;
use Simple\Validator\Contracts\Rule;

class TestRule extends Rule
{
    public function check($value)
    {
        //
    }
}

final class RuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function create_rule_without_chain()
    {
        $rule = new TestRule();

        $this->assertEquals(null, $rule->getNext());
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function create_rule_with_chain()
    {
        $nextRule = new TestRule();
        $rule = new TestRule([$nextRule]);

        $this->assertEquals($nextRule, $rule->getNext());
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function create_rule_with_chain_two_rule()
    {
        $first = new TestRule();
        $second = new TestRule();
        $rule = new TestRule([$first, $second]);

        $this->assertEquals($first, $rule->getNext());
        $this->assertEquals($second, $first->getNext());
        $this->assertEquals(null, $second->getNext());
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function get_next_value_get_value_exactly()
    {
        $rule = new TestRule();

        $this->assertEquals(10, $rule->getNextValue(10));
    }
}
