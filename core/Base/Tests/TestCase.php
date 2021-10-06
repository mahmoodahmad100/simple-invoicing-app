<?php

namespace Core\Base\Tests;

use Tests\TestCase as BaseTestCase;
use Core\Base\Traits\Response\SendResponse;

class TestCase extends BaseTestCase
{
    use SendResponse;
    
    /**
     * get the base url for API
     *
     * @codeCoverageIgnore
     * @param string $version
     * @return string
     */
    protected function getApiBaseUrl($version = 'v1')
    {
        return "api/{$version}/";
    }

    /**
     * get the needed headers for every request
     *
     * @codeCoverageIgnore
     * @param bool $is_auth
     * @return array
     */
    protected function getHeaders()
    {
        $headers = [
            'Accept'  => 'application/json'
        ];

        return $headers;
    }
}
