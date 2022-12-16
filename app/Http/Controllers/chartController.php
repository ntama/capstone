<?php

namespace App\Http\Controllers;

use App\Models\Ticker;
use Illuminate\Http\Request;


class chartController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
       return view('chart', self::constructHistoricChart("AAPL"));
    }

    public function constructHistoricChart($ticker): array
    {
        $data = collect(['AAPL', 'GOOG', 'META', 'TSLA', 'AMZN'])
            ->map(fn ($symbol) => Ticker::getPastMonth($symbol));

        $tickerInfo = Ticker::getSingleTickerData($data, $ticker);
        //gets table of headers (filters out inputted keys)
        $labels = Ticker::getHistoricalDate($tickerInfo);
        //gets values for headers
        $openValues = Ticker::getHistoricalKeyData($tickerInfo, 'open');
        $highValues = Ticker::getHistoricalKeyData($tickerInfo, 'high');
        $closeValues = Ticker::getHistoricalKeyData($tickerInfo, 'close');
        $lowValues = Ticker::getHistoricalKeyData($tickerInfo, 'low');

        return compact('labels',
            'openValues', 'highValues',
            'closeValues', 'lowValues');
    }

}
