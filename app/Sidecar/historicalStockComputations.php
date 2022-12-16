<?php
namespace App\Sidecar;
use Hammerstone\Sidecar\LambdaFunction;
use Hammerstone\Sidecar\Runtime;
use App\Http\Controllers\tickerCollectionController;
use App\Http\Controllers\tickerController;

class historicalStockComputations extends LambdaFunction
{
    public function handler()
    {
        // TODO: Implement handler() method.
        return 'resources/lambdas/historicalStockInfo.getInfo';
    }

    public function package()
    {
        // TODO: Implement package() method.
        return [
            'resources/lambdas/historicalStockInfo.py',
        ];
    }


    public function runtime()
    {
        return Runtime::PYTHON_38;
    }

    public function layers()
    {
        return([
            'arn:aws:lambda:us-east-1:668099181075:layer:AWSLambda-Python38-SciPy1x:107',
            'arn:aws:lambda:us-east-1:770693421928:layer:Klayers-p39-matplotlib:1'
        ]);
    }


}





