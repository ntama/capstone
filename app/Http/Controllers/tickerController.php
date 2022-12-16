<?php

namespace App\Http\Controllers;

use App\Sidecar\historicalStockComputations;
use Hammerstone\Sidecar\Sidecar;
use Illuminate\Http\Request;
use App\Models\Ticker;
use Illuminate\Support\Collection;


class tickerController extends Controller{


    private Collection $tickers;

    public function collectTickers(): Collection
    {
        return $this->tickers = collect(['AAPL'])
            ->map(fn ($symbol) => Ticker::getPastTwoWeeks($symbol));
    }

    public function convertJsonForLambda(Collection $tickerData): string
    {
        return $tickerData->toJson();
    }
}
