<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recurring Transfers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="text-base text-gray-400">@lang('Balance')</div>
                <div class="flex items-center pt-1">
                    <div class="text-2xl font-bold text-gray-900">
                        {{ \Illuminate\Support\Number::currencyCents($balance) }}
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <h2 class="text-xl font-bold mb-6">@lang('Create a recurring transfer')</h2>
                <form method="POST" action="{{ route('recurring-transfers.store') }}" class="space-y-4">
                    @csrf

                    @if (session('money-sent-status') === 'success')
                        <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            <span class="font-medium">@lang('Recurring Transfer created!')</span>
                            @lang('Your recurring transfer has been created')
                        </div>
                    @endif

                    <div>
                        <x-input-label for="recipient_email" :value="__('Recipient email')"/>
                        <x-text-input id="recipient_email"
                                      class="block mt-1 w-full"
                                      type="email"
                                      name="recipient_email"
                                      :value="old('recipient_email')"
                                      required/>
                        <x-input-error :messages="$errors->get('recipient_email')" class="mt-2"/>
                    </div>
                    <div>
                        <x-input-label for="amount" :value="__('Amount (€)')"/>
                        <x-text-input id="amount"
                                      class="block mt-1 w-full"
                                      type="number"
                                      min="0"
                                      step="0.01"
                                      :value="old('amount')"
                                      name="amount"
                                      required/>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2"/>
                    </div>
                    <div>
                        <x-input-label for="reason" :value="__('Reason')"/>
                        <x-text-input id="reason"
                                      class="block mt-1 w-full"
                                      type="text"
                                      :value="old('reason')"
                                      name="reason"
                                      required/>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')"/>
                        <x-date-input id="start_date"
                                      class="block mt-1 w-full"
                                      type="text"
                                      :value="old('start_date')"
                                      name="start_date"
                                      required/>
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('End Date')"/>
                        <x-date-input id="end_date"
                                      class="block mt-1 w-full"
                                      type="text"
                                      :value="old('end_date')"
                                      name="end_date"
                                      required/>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2"/>
                    </div>

                    <div>
                        <x-input-label for="frequency" :value="__('Frequency')"/>
                        <x-number-input id="frequency"
                                        class="block mt-1 w-full"
                                        type="text"
                                        min="1"
                                        :value="old('frequency') ?? 1"
                                        name="frequency"
                                        required/>
                        <x-input-error :messages="$errors->get('frequency')" class="mt-2"/>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Send my money !') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <h2 class="text-xl font-bold mb-6">@lang('Recurring transfers')</h2>
                <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            @lang('ID')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Reason')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Start Date')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('End Date')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Frequency')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Amount')
                        </th>
                        <th scope="col" class="px-6 py-3">
                            @lang('Recipient Email')
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recurringTransfers as $recurringTransfer)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$recurringTransfer->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$recurringTransfer->reason}}
                            </td>
                            <td class="px-6 py-4">
                                {{$recurringTransfer->start_date->format('d/m/Y')}}
                            </td>
                            <td class="px-6 py-4">
                                {{$recurringTransfer->end_date->format('d/m/Y')}}
                            </td>
                            <td class="px-6 py-4">
                                {{ __('Each :frequency days', [
                                    'frequency' => $recurringTransfer->frequency
                                ]) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Illuminate\Support\Number::currencyCents($recurringTransfer->amount) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $recurringTransfer->recipient_email }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
