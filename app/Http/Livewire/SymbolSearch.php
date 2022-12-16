<?php

namespace App\Http\Livewire;

use App\Models\Ticker;
use GuzzleHttp\Exception\ClientException;
use Livewire\Component;
use Scheb\YahooFinanceApi\Exception\ApiException;

class SymbolSearch extends Component
{
    public string $query = "";
    public string $history = "";

    public function render()
    {
        return view('livewire.symbol-search');
    }

    public function search() {

        try {
            switch ($this->history) {
                case '-7 days':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastWeek($this->query)
                    ]);
                    break;
                case '-14 days':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastTwoWeeks($this->query)
                    ]);
                    break;
                case '-30 days':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastMonth($this->query)
                    ]);
                    break;
                case '-90 days':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastSixMonths($this->query)
                    ]);
                    break;
                case '-12 months':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastYear($this->query)
                    ]);
                    break;
                case '-5 years':
                    $this->emit('search.result', [
                        'symbol' => $this->query,
                        'data' => Ticker::getPastFiveYears($this->query)
                    ]);
                    break;
            }
        } catch (ApiException|ClientException $exception) {
            $search = Ticker::lookup($this->query);

            if ($search->isNotEmpty()) {
                $this->addError('invalid_ticker', $this->query . ', is not a valid stock ticker. Did you mean: <b>' . $search->first()->getSymbol() . '</b>');
            }

            if ($search->isEmpty()) {
                $this->addError('invalid_ticker', $this->query . " is not a valid stock ticker, and we couldn't find any similar tickers.");
            }
        }
    }
}
