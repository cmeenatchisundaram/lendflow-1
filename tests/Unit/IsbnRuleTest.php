<?php

namespace Tests\Unit;

use App\Rules\IsbnRule;
use PHPUnit\Framework\TestCase;

class IsbnRuleTest extends TestCase
{
    /**
     * @var IsbnRule
     */
    protected IsbnRule $rule;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->rule = new IsbnRule();
    }

    /**
     * @return \string[][]
     */
    public function validIsbnsProvider()
    {
        return [
            ['1234567890'],
            ['1234567890123'],
            ['1234567890;1234567890123'],
            ['1234567890;1234567890123;1234567890'],
        ];
    }

    /**
     * @return array
     */
    public function inValidIsbnsProvider()
    {
        return [
            [null],
            [''],
            [' '],
            [5],
            [-588899],
            [12334567890],
            ['123'],
            ['12345678901'],
            ['12345678901234'],
            ['1234567890#1234567890123'],
            ['1234567890;1234567890123@1234567890'],
        ];
    }

    /**
     * @dataProvider validIsbnsProvider
     * @param $isbn
     * @return void
     */
    public function testValidIsbnsPass($isbn)
    {
        $this->assertTrue($this->rule->passes('isbn',$isbn));
    }

    /**
     * @dataProvider inValidIsbnsProvider
     * @param $isbn
     * @return void
     */
    public function testInvalidIsbnsFail($isbn)
    {
        $this->assertFalse($this->rule->passes('isbn',$isbn));
    }
}
