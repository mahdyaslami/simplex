<?php

namespace SimpleTests\Validator\Contracts;

use Exception;
use Simple\Test\TestCase;
use Simple\Validator\Contracts\Rule;

class TestRule extends Rule
{
    public function check($value)
    {
        //
    }
}

class IncorrectRule extends rule
{
    public function check($value)
    {
        throw new Exception('Incorrect.');
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

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function validate_incorrect_without_chain()
    {
        $rule = new IncorrectRule();

        try {
            $rule->validate(10);
        } catch (\Throwable $e) {
            $this->assertEquals('Incorrect.', $e->getMessage());
        }
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function validate_incorrect_with_chain()
    {
        $nextRule = new IncorrectRule();
        $rule = new TestRule([$nextRule]);

        try {
            $rule->validate(10);
        } catch (\Throwable $e) {
            $this->assertEquals('Incorrect.', $e->getMessage());
        }
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function validate_without_chain()
    {
        $rule = new TestRule();

        $catched = false;
        try {
            $rule->validate(10);
        } catch (\Throwable $e) {
            $catched = true;
        }

        $this->assertFalse($catched, 'Validate without chain failed.');
    }

    /**
     * @test
     * @covers \Simple\Validator\Contracts\Rule
     */
    public function validate_with_chain()
    {
        $nextRule = new TestRule();
        $rule = new TestRule([$nextRule]);

        $catched = false;
        try {
            $rule->validate(10);
        } catch (\Throwable $e) {
            $catched = true;
        }

        $this->assertFalse($catched, 'Validate without chain failed.');
    }
}
