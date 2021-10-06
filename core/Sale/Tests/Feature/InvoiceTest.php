<?php

namespace Core\Sale\Tests\Feature;

use Core\Base\Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * the base url
     *
     * @var string
     */
    protected $base_url;

    /**
     * the json response
     *
     * @var array
     */
    protected $json;

    /**
     * setting up
     *
     * @throws \ReflectionException
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->base_url = $this->getApiBaseUrl() . 'invoices/';
        $this->json     = json_decode($this->sendResponse([], 'successfully generated.', true, 200), true);
    }

    public function testItShouldReturnInvoiceWithDiscounts()
    {
        $data = [
            'products' => [
                'T-shirt',
                'Blouse',
                'Pants',
                'Shoes',
                'Jacket'
            ]
        ];

        $this->json['data'] = [
            'currency' => [
                'code'   => 'USD',
                'symbol' => '$'
            ],
            'subtotal'  => 386.95,
            'shipping'  => 110,
            'VAT'       => 54.173,
            'discounts' => [
                '10% off shoes'   => -7.999,
                '50% off jacket'  => -99.995,
                '$10 of shipping' => -10
            ],
            'total' => 433.129
        ];

        $this->json('POST', $this->base_url, $data, $this->getHeaders())
             ->assertStatus(200)
             ->assertJson($this->json);
    }

    public function testItShouldReturnInvoiceWithoutDiscounts()
    {
        $data = [
            'products' => [
                'Jacket'
            ]
        ];

        $this->json['data'] = [
            'currency' => [
                'code'   => 'USD',
                'symbol' => '$'
            ],
            'subtotal' => 199.99,
            'shipping' => 44,
            'VAT'      => 27.9986,
            'total'    => 271.9886
        ];

        $this->json('POST', $this->base_url, $data, $this->getHeaders())
             ->assertStatus(200)
             ->assertJson($this->json);
    }
}
