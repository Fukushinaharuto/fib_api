<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FibonacciControllerTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('fibonacciDataProvider')]
    public function testFibonacciSequence($input, $expected)
    {
        $response = $this->getJson("/api/fib?n={$input}");
        $response->assertStatus(200)->assertJson(['result' => $expected]);
    }

    public static function fibonacciDataProvider()
    {
        return [
            'testOneInput' => [1, '1'],
            'testTwoInput' => [2, '1'],
            'testThreeInput' => [3, '2'],
            'testFiveInput' => [5, '5'],
            'testTenInput' => [10, '55'],
            'testTwentyInput' => [20, '6765'],
            'testFiftyInput' => [50, '12586269025'],
            'testNinetyNineInput' => [99, '218922995834555169026'],
        ];
    }

    public function testInvalidInput()
    {
        $response = $this->getJson('/api/fib?n=invalid');
        $response->assertStatus(422);
    }

    public function testMissingInput()
    {
        $response = $this->getJson('/api/fib');
        $response->assertStatus(422);
    }

    public function testNegativeInput()
    {
        $response = $this->getJson('/api/fib?n=-1');
        $response->assertStatus(422);
    }
}
