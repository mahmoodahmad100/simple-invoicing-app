<?php

namespace Core\Sale\Models;

use Core\Sale\Logic\Handle;

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
            $this->setSubtotal($item['price']);
            $this->setShipping($item);
        }

        $this->setTaxes();
        $this->setOffers($products);
        $this->setTotal();

        return $this->data;
    }

    /**
     * set the subtotal
     * 
     * @param  float $value
     * @return void
     */
    protected function setSubtotal($value)
    {
        $this->data['subtotal'] += $value;
    }

    /**
     * set the shipping
     * 
     * @param  array $item
     * @return void
     */
    protected function setShipping($item)
    {
        $rates                  = $this->config['shipping_rates'];
        $weight                 = uom_converter($item['weight'], $this->config['items']['uom'], $rates['uom']);
        $shipping               =  $rates['countries'][$item['shipped_from']] * $weight / $rates['amount'];
        $this->data['shipping'] = $this->data['shipping'] == 0 ? $shipping : $this->data['shipping'] + $shipping;
    }

    /**
     * set the taxes
     * 
     * @return void
     */
    protected function setTaxes()
    {
        $this->data['taxes'] = 0;
        foreach ($this->config['items']['taxes'] as $tax) {
            $tax_item = $this->config['taxes'][$tax];
            $this->data[$tax_item['name']] = $this->handleApply($tax_item);
            $this->data['taxes']          += $this->data[$tax_item['name']];
        }
    }

    /**
     * set the offers
     * 
     * @param  array $products
     * @return void
     */
    protected function setOffers(array $products)
    {
        $this->data['discounts'] = ['total' => 0];

        foreach ($this->config['offers'] as $offer) {
            $min_qty = 0;
            foreach ($products as $product) {

                $condition = $offer['condition'];

                if ($condition['type'] == 'item_in') {
                    if (in_array('*', $condition['items']) || in_array($product, $condition['items'])) {
                        $min_qty += 1;

                        if ($condition['min_qty'] == $min_qty) {
                            $this->data['discounts'][$offer['name']] = $this->handleApply($offer['discount'], 'decrease');
                            $this->data['discounts']['total']       += $this->data['discounts'][$offer['name']];
                        }
                    }
                }

            }
        }
    }

    /**
     * set the total
     * 
     * @return void
     */
    protected function setTotal()
    {
        $this->data['total'] = $this->data['subtotal'] + $this->data['shipping'] + $this->data['taxes'];
        
        if ($this->data['discounts']['total'] < 0) {
            $this->data['total'] += $this->data['discounts']['total'];
        }

        if ($this->data['discounts']['total'] < 0) {
            unset($this->data['discounts']['total']);
        } else {
            unset($this->data['discounts']);
        }

        unset($this->data['taxes']);
    }

    /**
     * handle the apply
     * 
     * @param  array  $item
     * @param  string $operation
     * @return float
     */
    protected function handleApply($item, $operation = 'increase')
    {
        $data = [
            'type'  => $item['type'],
            'value' => $item['value'],
        ];

        if ($item['type'] == 'percentage') {
            if ($item['apply'] == 'subtotal') {
                $data['number'] = $this->data['subtotal'];
            }

            if ($item['apply'] == 'items') {
                $data['number'] = 0;
                foreach ($item['items'] as $product) {
                    $data['number'] += $this->config['items']['types'][$product]['price'];
                }
            }

            if ($item['apply'] == 'subtotal') {
                $data['number'] = $this->data['subtotal'];
            }
            
        }

        $value = Handle::fire('calculate', $data, $operation);

        if(isset($item['capped_amount']) && $value > $item['capped_amount']) {
            $value = $item['capped_amount'];
        }

        return $value;
    }
}
