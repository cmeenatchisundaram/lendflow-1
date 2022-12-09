<?php

namespace Tests\Feature;

use Tests\TestCase;

class NytBestSellerRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @return array[]
     */
    public function inValidDataProvider()
    {
        return [
            [    'invalid_isbn' => ['isbn'=>123,'author'=>'testing','title'=>'testing','offset'=>20 ]],
            [    'invalid_isbn_null' => ['isbn'=>null,'author'=>'testing','title'=>'testing','offset'=>20 ]],
            [    'invalid_isbn_empty' => ['isbn'=>'  ','author'=>'testing','title'=>'testing','offset'=>20 ]],
            [    'invalid_offset' => ['isbn'=>'1234567890','author'=>'testing','title'=>'testing','offset'=>10 ]],
            [    'invalid_title' => ['isbn'=>'1234567890','author'=>'testing','title'=>'','offset'=>20 ]],
            [    'invalid_author' => ['isbn'=>'1234567890','author'=>null,'title'=>'testing','offset'=>20 ]],
            [    'invalid_isbn_offset' => ['isbn'=>123,'author'=>'testing','title'=>'testing','offset'=>10 ]],
        ];
    }

    /**
     * @dataProvider inValidDataProvider
     * @param $inValidParams
     * @return void
     */
    public function testNytBestSellersRequestParamsWithInvalidData($inValidParams)
    {
        $this->call('GET','/api/1/nyt/best-sellers', $inValidParams)
            ->assertStatus(422);
    }
}
