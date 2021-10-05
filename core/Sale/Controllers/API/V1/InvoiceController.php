<?php

namespace Core\Sale\Controllers\API\V1;

use Core\Sale\Requests\InvoiceRequest as FormRequest;

class InvoiceController extends \Core\Base\Controllers\API\Controller
{
    /**
     * Init.
     * 
     * @param  FormRequest $request
     * @return void
     */
    public function __construct(FormRequest $request)
    {
        $this->request  = $request;
    }

    /**
     * price a cart of products and display a total detailed invoice
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function invoice()
    {
        return $this->sendResponse(
            ['50% from 1000' => get_percentage_value(1000, 50), 'products' => $this->request->products],
            'successfully generated.',
            true,
            200);
    }
}
