<?php

namespace App\Sidecar;

use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Runtime;

class HelloWorld extends LambdaFunction
{
    public function handler()
    {
        // TODO: Implement handler() method.
        return 'resources/lambdas/helloworld.say_hello';
    }

    public function package()
    {
        // TODO: Implement package() method.
        return [
            'resources/lambdas/helloworld.py',
        ];
    }

    public function runtime()
    {
        return Runtime::PYTHON_38;
    }
}
