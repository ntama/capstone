<?php

namespace App\Http\Livewire;

use App\Models\Ticker;
use App\Sidecar\historicalStockComputations;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Livewire\Component;

class TickerTable extends Component
{
    public Collection $tickers;

    public function render()
    {
        return view('livewire.ticker-table');
    }

    public function mount()
    {
        // Create a new client from the factory
        $this->tickers = collect(['AAPL', 'GOOG', 'META', 'TSLA', 'AMZN'])
            ->map(fn ($symbol) => Ticker::getPastMonth($symbol));
    }
}
