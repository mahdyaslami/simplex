<?php

namespace SimpleTests\Test\TestCaseTest;

use Simple\Test\TestCase;
use Simple\Validator\RequiredRule;

final class RequiredRuleTest extends TestCase
{
    /**
     * @test
     * @covers \Simple\Validator\RequiredRule
     * @uses \Simple\Test\TestCase
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
     * @uses \Simple\Test\TestCase
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
     * @uses \Simple\Test\TestCase
     */
    public function work_with_std_object()
    {
        $rule = new RequiredRule('id');

        $rule->validate((object) [
            'id' => 1
        ]);

        $this->assertTrue(true);
    }
}
