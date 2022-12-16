<div class="w-full" x-data="chart" x-show="showing">

    <div class="px-4 sm:px-6 lg:px-8">
        <h1 class="w-full bg-white rounded shadow text-center text-lg font-medium uppercase py-3">
            Historical data graphed for: {{$searchName}}
        </h1>
    </div>

    <div class="px-4 sm:px-6 lg:px-8">
        <canvas class="w-full bg-white rounded shadow" x-ref="chart"></canvas>
    </div>

    <div class="px-2 py-4" x-data="{ open: false }">
        <button
            class="bg-indigo-500 text-indigo-100 px-4 py-4 uppercase rounded shadow ml-8"
            x-on:click="open = !open">
            Show Data
        </button>

        <div class="sm:px-6 lg:px-8" x-show="open">
            <div class="mt-4-8 flex flex-col pb-3">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <h1 class="text-center text-lg uppercase rounded px-2 py-3">
                                Values for: {{$searchName}}
                            </h1>
                            <table class="min-w-full divide-y py-12 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">High</th>
                                        <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Low</th>
                                        <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Market Open</th>
                                        <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Market Close</th>
                                    </tr>
                                    </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @if($data)
                                        @foreach($data as $datum)
                                        <tr>
                                                <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">
                                                    {{ $datum['high'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">
                                                    {{ $datum['low'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
                                                    {{  $datum['open'] }}
                                                </td>
                                                <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
                                                    {{ $datum['close'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {
            Alpine.data('chart', () => ({
                showing: @entangle('showing'),
                config: @entangle('config'),
                labels: @entangle('labels'),
                datasets: @entangle('datasets'),

                init() {
                    let chart = new Chart(this.$refs.chart.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: this.labels,
                            datasets: this.datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            padding: 10,
                            scales: {
                                x: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'DATE (Y-M-D)',
                                        color: '#944',
                                        padding: {top: 10, left: 0, right: 0, bottom: 10}
                                    }
                                },
                                y: {
                                    display: true,
                                    title: {
                                        display: true,
                                        text: 'PRICE IN USD ($)',
                                        color: '#191',
                                        padding: {top: 10, left: 0, right: 0, bottom: 10}
                                    }
                                },
                            }
                        }
                    });

                    this.$watch('datasets', () => {
                        chart.data.labels = this.labels;
                        chart.data.datasets = this.datasets;
                        chart.update();
                    })
                }
            }))
        });
    </script>
</div>
