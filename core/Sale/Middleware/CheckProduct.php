<?php

namespace Core\Sale\Middleware;

use Closure;
use Core\Base\Traits\Response\SendResponse;

class CheckProduct
{
    use SendResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($request->products as $product) {
            if (!isset(config('core_sale.items.types')[$product])) {
                return $this->sendResponse([], "{$product} is not found", false, 422);
            }
        }

        return $next($request);
    }
}
