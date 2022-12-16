<?php

namespace App\Http\Livewire;

use App\Models\Ticker;
use Illuminate\Support\Collection;
use Livewire\Component;

class StockGraph extends Component
{
    /*
       config: @entangle('config'),
       labels: @entangle('labels'),
       datasets: @entangle('datasets'),
     */
    public string $ticker = '';
    public Collection $data;
    public string $searchName = '';
    public bool $showing = false;
    public array $config = [];
    public array $options = [];
    public array $labels = [];
    public array $datasets = [];

    //Renders the view
    public function render()
    {
        return view('livewire.stock-graph');
    }
    //waits for listeners to be activated
    public function getListeners(): array
    {
        return [
            'search.result' => 'resultFound'
        ];
    }

    //Fills ChartJS fields with respective data
    public function resultFound($event) {
        $this->reset(['ticker', 'labels', 'datasets', 'options']);
        $this->data = collect($event['data']);
        $this->ticker = $event['symbol'];
        $this->labels = Ticker::getHistoricalDate($this->data)->toArray();
        $this->datasets = [
            [
                'label' => 'open',
                'data' => Ticker::getHistoricalKeyData(collect($event['data']), 'open')->toArray(),
                'fill' => false,
                'borderColor' => ['rgba(75, 192, 192)'],
                'tension' =>0.1
            ],
            [
                'label' => 'high',
                'data' => Ticker::getHistoricalKeyData(collect($event['data']), 'high')->toArray(),
                'fill' => false,
                'borderColor' => ['rgba(241,16,107)'],
                'tension' => 0.1
            ],
            [
                'label' => 'close',
                'data' => Ticker::getHistoricalKeyData(collect($event['data']), 'close')->toArray(),
                'fill' => false,
                'borderColor' => ['rgba(158,236,67)'],
                'tension' => 0.1
            ],
            [
                'label' => 'low',
                'data' => Ticker::getHistoricalKeyData(collect($event['data']), 'low')->toArray(),
                'fill' => false,
                'borderColor' => ['rgba(191,67,236)'],
                'tension' => 0.1
            ]
        ];
        $temp = collect(Ticker::lookup($event['symbol'])->get(0));
        $this->searchName = $temp->get('name');
        $this->config = [
            'type' => 'line',
            'data' => $this->datasets,
            'options' => $this->options,
        ];
        // display results...
        $this->showing = ! $this->showing;
    }
}
