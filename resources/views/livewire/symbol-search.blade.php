<div class="max-w-7xl p-8 mt-10 mx-auto">
    <div class="">
        <h1 class="font-black text-4xl">Welcome, {{ Auth::user()->name }}</h1>
        <form>
            <div>
                <input class="w-full rounded shadow py-2 px-3 border-gray-300 my-2" type="text" name="query" id="query" placeholder="AAPL" wire:model="query">
                @error('invalid_ticker')
                    <span class="text-red-500 font-semibold">
                        {!! $message !!}
                    </span>
                @enderror
            </div>

            <div class="mt-6">
                <label class="text-base font-medium text-gray-500 uppercase kerning-loose">History</label>
                <fieldset class="mt-2">
                    <legend class="sr-only">History</legend>
                    <div class="space-y-2 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                        <div class="flex items-center">
                            <input wire:model="history" id="one-week" value="-7 days" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="one-week" class="ml-3 block text-sm font-medium text-gray-700">1 Week</label>
                        </div>

                        <div class="flex items-center">
                            <input wire:model="history" id="two-weeks" value="-14 days" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="two-weeks" class="ml-3 block text-sm font-medium text-gray-700">2 Weeks</label>
                        </div>

                        <div class="flex items-center">
                            <input wire:model="history" id="one-month" value="-30 days" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="one-month" class="ml-3 block text-sm font-medium text-gray-700">1 Month</label>
                        </div>

                        <div class="flex items-center">
                            <input wire:model="history" id="six-months" value="-90 days" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="six-months" class="ml-3 block text-sm font-medium text-gray-700">6 Months</label>
                        </div>

                        <div class="flex items-center">
                            <input wire:model="history" id="one-year" value="-12 months" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="one-year" class="ml-3 block text-sm font-medium text-gray-700">1 Year</label>
                        </div>

                        <div class="flex items-center">
                            <input wire:model="history" id="five-years" value="-5 years" name="history-method" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="five-years" class="ml-3 block text-sm font-medium text-gray-700">5 years</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="mt-6">
                <button wire:click="search" type="button" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Search Symbol

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-3 -mr-1 h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                </button>
            </div>
        </form>
    </div>
</div>
