<?php

namespace Core\Sale\Logic;

class Handle
{
    /**
     * fire event
     * 
     * @param  string $type
     * @param  array  $data
     * @return float
     * @throws \Exception
     */
    public static function fire($type, $data, $operation = 'increase')
    {
        $value = 0;

        switch ($type) {
            case 'calculate':
                $object = new Calculate($data);
                $value  = $object->apply();
                break;
            default:
                throw new \Exception('unknown type passed');
                break;
        }

        return $operation == 'increase' ? $value : -$value;
    }
}