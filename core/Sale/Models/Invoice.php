<?php

namespace Core\Sale\Models;

class Invoice
{
    /**
     * the configuration
     * 
     * @var array
     */
    protected $config = [];

    /**
     * data returned from the model
     * 
     * @var array
     */
    protected $data = [];

    /**
     * Init.
     *
     * @return void
     */
    public function __construct()
    {
        $this->config = config('core_sale');
        $this->data   = [
            'currency' => $this->config['currency'],
            'subtotal' => 0,
            'shipping' => 0
        ];
    }

    /**
     * create new invoice
     * 
     * @param  string[] $products
     * @return array
     */
    public function create($products)
    {
        foreach ($products as $product) {
            $item = $this->config['items']['types'][$product];
            $this->data['subtotal'] += $item['price'];

            // shipping
            $shipping_rates = $this->config['shipping_rates'];
            $weight_in_gram = $item['weight'] * 1000;
            $shipping       =  $shipping_rates['countries'][$item['shipped_from']] * $weight_in_gram / $shipping_rates['amount'];
            $this->data['shipping'] = $this->data['shipping'] == 0 ? $shipping : $this->data['shipping'] + $shipping;
        }

        // taxes
        $taxes = 0;
        foreach($this->config['items']['taxes'] as $tax) {
            $tax_item = $this->config['taxes'][$tax];

            $tax_value = 0;

            if ($tax_item['apply'] == 'item') {
                // some stuff
            }

            if ($tax_item['apply'] == 'subtotal') {
                $tax_value = $tax_item['type'] == 'percentage' ? get_percentage_value($this->data['subtotal'], $tax_item['value']) : $tax_item['value'];
            }

            $this->data[$tax_item['name']] = $tax_value;
            $taxes += $this->data[$tax_item['name']];
        }

        return $this->data;
    }
}
