<?php

namespace Simple\Validator\Contracts;

abstract class Rule
{
    private $next = null;

    /**
     * Create an object with chained rules.
     * 
     * @param array<Rule> $rule
     */
    public function __construct(array $rules = [])
    {
        if ($this->chain($rules)) {
            $this->setNext($rules[0]);
        }
    }

    protected function chain($rules)
    {
        $count = count($rules);

        if ($count == 0) {
            return false;
        }

        for ($i = 1; $i < $count; $i++) {
            $rules[$i - 1]->setNext($rules[$i]);
        }

        return true;
    }

    public function setNext(Rule $next)
    {
        $this->next = $next;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function validate($value)
    {
        $this->check($value);

        if ($next = $this->getNext()) {
            $next->validate($value);
        }
    }

    /**
     * check value by rules.
     * 
     * @param  mixed $value The value you want to check.
     * @return void
     */
    public abstract function check($value);
}
