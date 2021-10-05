<?php

namespace Core\Sale\Controllers\API\V1;

use Core\Sale\Requests\InvoiceRequest as FormRequest;
use Core\Sale\Models\Invoice as Model;

class InvoiceController extends \Core\Base\Controllers\API\Controller
{
    /**
     * Init.
     * 
     * @param  FormRequest $request
     * @param  Model $model
     * @return void
     */
    public function __construct(FormRequest $request, Model $model)
    {
        $this->request = $request;
        $this->model   = $model;
    }

    /**
     * price a cart of products and display a total detailed invoice
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function invoice()
    {
        return $this->sendResponse(
            $this->model->create($this->request->products),
            'successfully generated.',
            true,
            200
        );
    }
}
