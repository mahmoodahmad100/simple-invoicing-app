<?php

namespace Core\Sale\Logic;

use Core\Sale\Interfaces\InvoiceInterface;

class Calculate implements InvoiceInterface
{
    /**
     * the data
     * 
     * @var array
     */
    protected $data;

    /**
     * Init.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * apply the changes
     * 
     * @return float
     */
    public function apply()
    {
        if ($this->data['type'] == 'percentage') {
            return get_percentage_value($this->data['number'], $this->data['value']);
        }

        return $this->data['value'];
    }
}