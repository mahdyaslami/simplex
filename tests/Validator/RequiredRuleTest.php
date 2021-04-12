<?php

namespace Tests\Validator;

use Simple\Test\TestCase;
use Simple\Validator\Exceptions\OnlyIntegerAllowedException;
use Simple\Validator\RequiredRule;
use Simple\Validator\Scaler\IntegerRule;
use Simple\Validator\Scaler\MaximumRule;

final class RequiredRuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     */
    public function throw_exception_when_key_does_not_exists()
    {
        $rule = new RequiredRule('id');

        try {
            $rule->validate([]);
        } catch (\Throwable $e) {
            $this->assertEquals('id does not exists.', $e->getMessage());
        }
    }

    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     */
    public function does_not_throw_exception_when_key_exists()
    {
        $rule = new RequiredRule('id');

        $rule->validate([
            'id' => 1
        ]);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     */
    public function work_with_std_object()
    {
        $rule = new RequiredRule('id');

        $rule->validate((object) [
            'id' => 1
        ]);

        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     */
    public function chain_rules_together_check_first_rule_of_array()
    {
        $rule = new RequiredRule('id', [new IntegerRule(), new MaximumRule(10)]);

        $catched = false;
        try {
            $rule->validate([
                'id' => '11'
            ]);
        } catch (OnlyIntegerAllowedException $e) {
            $catched = true;
        }

        $this->assertTrue($catched, 'First element of chained rule does not checked.');
    }

    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     */
    public function chain_rules_together_check_second_rule_of_array()
    {
        $rule = new RequiredRule('id', [new IntegerRule(), new MaximumRule(10)]);

        $catched = false;
        try {
            $rule->validate([
                'id' => '11'
            ]);
        } catch (OnlyIntegerAllowedException $e) {
            $catched = true;
        }

        $this->assertTrue($catched, 'First element of chained rule does not checked.');
    }
}
