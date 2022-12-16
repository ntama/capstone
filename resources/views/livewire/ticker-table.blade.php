<div class="px-4 sm:px-6 lg:px-8">
    @foreach($tickers as $ticker)
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto py-4">
                <h1 class="text-xl font-semibold text-gray-900">Tickers</h1>
                @foreach($ticker as $symbol => $data)
                    <p class="mt-2 text-lg text-gray-700">
                        Historic Data for: {{$symbol}}
                    </p>
                @endforeach
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button type="button" onclick="window.location.href='/chart'"
                        class="inline-flex items-center justify-center rounded-md border border-transparent
                        bg-indigo-600 px-4 py-2 text-sm font-medium text-white
                        shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2
                        focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto" id="graphButton">
                    Graph</button>
            </div>

        </div>
        <div class="mt-4-8 flex flex-col pb-3">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
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
                                @foreach($ticker as $symbol => $data)
                                    @foreach($data as $day)
                                        <tr>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">
                                            {{ $day->getHigh() }}
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">
                                            {{ $day->getLow() }}
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
                                            {{ $day->getOpen() }}

                                        </td>
                                        <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">
                                            {{ $day->getClose() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
