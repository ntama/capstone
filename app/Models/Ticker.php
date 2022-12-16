<?php

namespace App\Models;

use App\Sidecar\historicalStockComputations;
use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hammerstone\Sidecar\Sidecar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;
use PolygonIO\Rest\Rest;
use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;
use Scheb\YahooFinanceApi\Exception\ApiException;
use Scheb\YahooFinanceApi\Results\SearchResult;

class Ticker extends YFinanceModel
{

    use HasFactory;

    ////////////////////COLLECT HISTORIC TICKER INFO/////////////////////////////////
    /*
     * The lookup function looks up any tickers close to what
     * the user inputted. Takes in a ticker returns a collection
     * of data being the ticker itself, full name, then some
     * general market data
     */
    public static function lookup(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        try {
            return collect($client->search($symbol));
        } catch (ApiException) {
            return collect([]);
        }
    }
    /**
     * @param string $symbol
     * @return Collection
     * @throws ApiException
     *
     * Collect historical market data over the given intervals of time.
     * These are 1 and 2 weeks, 1 and 6 months, and 1 and 5 years.
     * They take in a Ticker as a string and return a collection full
     * of JSON objects
     */
    public static function getPastWeek(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect(
            $client->getHistoricalQuoteData(
                $symbol,
                ApiClient::INTERVAL_1_DAY,
                new DateTime('-7 days'),
                new DateTime('today')
            ));

        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }
    public static function getPastTwoWeeks(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect(
            $client->getHistoricalQuoteData(
                $symbol,
                ApiClient::INTERVAL_1_DAY,
                new DateTime('-14 days'),
                new DateTime('today')
            ));

        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }
    public static function getPastMonth(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect($client->getHistoricalQuoteData(
            $symbol,
            ApiClient::INTERVAL_1_DAY,
            new DateTime('-30 days'),
            new DateTime('today')
        ));

        //return statement////////////////////
        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }
    public static function getPastSixMonths(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect($client->getHistoricalQuoteData(
            $symbol,
            ApiClient::INTERVAL_1_DAY,
            new DateTime('-90 days'),
            new DateTime('today')
        ));

        //return statement////////////////////
        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }
    public static function getPastYear(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect($client->getHistoricalQuoteData(
            $symbol,
            ApiClient::INTERVAL_1_MONTH,
            new DateTime('-12 months'),
            new DateTime('today')
        ));

        //return statement////////////////////
        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }
    public static function getPastFiveYears(string $symbol): Collection
    {
        $client = ApiClientFactory::createApiClient();

        //collect the raw data////////////////
        $data = collect($client->getHistoricalQuoteData(
            $symbol,
            ApiClient::INTERVAL_1_MONTH,
            new DateTime('-5 years'),
            new DateTime('today')
        ));

        //return statement////////////////////
        try {
            return $data;
        } catch (ApiException) {
            return collect([]);
        }
    }


    /////////////////////////////GENERAL UTILITY/////////////////////////////////////////////
    /*
     * These functions collect specific subsets of data needed in various
     * parts of the project. Most of which are self explanatory but
     * there consists some overlap.
     */
    //Gets the data for a single ticker out of an array of tickers
    public static function getSingleTickerData(Collection $data, string $symbol): Collection
    {
        return $keyData = collect($data->value($symbol));
    }
    //Collects the keys for each entry of data within the collection
    public static function collectKeys(Collection $data): Collection
    {
        return collect($data->get(0))->keys();
    }
    //Collects specific subsets of data based on the index of the array
    public static function getDataByIndex(Collection $data, $index): Collection
    {
        return collect($data->get($index));
    }
    //Collects the data for specific keys related to the historical data (high, low, open, close, etc.)
    public static function getHistoricalKeyData(Collection $data, $key): Collection
    {
        //Var initialization
        $tickerData = $data;
        $dataCount = $tickerData->count();
        $keyCount = collect($tickerData->get(0))->count();

        $keyData = collect();
        //Loop that parses data to get the data into
        for ($x = 0; $x < $dataCount; $x++) {
            $tempData = (self::getDataByIndex($tickerData, $x))->get($key);
            $keyData->push($tempData);
        }
        return $keyData;

    }
    //Collects the dates of each row of data (Stored as a DateTime obj. required own function)
    public static function getHistoricalDate(Collection $data): Collection
    {
        $dates = self::getHistoricalKeyData($data, 'date');
        $dataCount = $dates->count();

        $datesFinal = collect();
        for ($x = 0; $x < $dataCount; $x++) {
            $tempData = (self::getDataByIndex($dates, $x))->get('date');
            $tempData = substr($tempData, 0, 10);
            $datesFinal->push($tempData);
        }

        return $datesFinal;

    }
}
