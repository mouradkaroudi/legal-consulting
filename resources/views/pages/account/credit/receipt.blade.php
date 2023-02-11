<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl': 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700&display=swap" rel="stylesheet">

    <title>{{ __('Receipt No') }}: {{ $txn->id }}</title>

    @vite(['resources/css/app.css'])
</head>

<body>
    <section class="py-4">
        <div class="max-w-5xl mx-auto py-16 bg-white">
            <article class="overflow-hidden">
                <div class="bg-white rounded-b-md">
                    <div class="p-9">
                        <div class="space-y-6 text-slate-700">
                            <p class="text-xl font-extrabold tracking-tight uppercase font-body">
                                {{ setting('general_settings_site_name_' . app()->getLocale()) }}
                            </p>
                        </div>
                    </div>
                    <div class="p-9">
                        <div class="flex w-full">
                            <div class="grid grid-cols-4 gap-12">
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">
                                        {{ __('Invoice Detail') }}:
                                    </p>
                                    <p>Unwrapped</p>
                                    <p>Fake Street 123</p>
                                    <p>San Javier</p>
                                    <p>CA 1234</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">{{ __('Billed To') }}</p>
                                    <p>The Boring Company</p>
                                    <p>Tesla Street 007</p>
                                    <p>Frisco</p>
                                    <p>CA 0000</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">{{ __('Invoice Number') }}</p>
                                    <p>000000</p>

                                    <p class="mt-2 text-sm font-normal text-slate-700">
                                        {{ __('Date of Issue') }}
                                    </p>
                                    <p>00.00.00</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">Terms</p>
                                    <p>0 Days</p>

                                    <p class="mt-2 text-sm font-normal text-slate-700">Due</p>
                                    <p>00.00.00</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-9">
                        <div class="flex flex-col mx-0 mt-8">
                            <table class="min-w-full divide-y divide-slate-500">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left rtl:text-right text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                            {{ __('Description') }}
                                        </th>
                                        <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0">
                                            {{ __('Amount') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-slate-200">
                                        <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                            <div class="font-medium text-slate-700">
                                                {{ $txn->description }}
                                            </div>
                                        </td>
                                        <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            <x-money amount="{{ $txn->amount }}" currency="sar" convert="true" />
                                        </td>
                                    </tr>

                                    <!-- Here you can write more products/tasks that you want to charge for-->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                            {{ __('Subtotal') }}
                                        </th>
                                        <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                            {{ __('Subtotal') }}
                                        </th>
                                        <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            <x-money amount="{{ $txn->amount }}" currency="sar" convert="true" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                            {{ __('Tex') }}
                                        </th>
                                        <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                            {{ __('Tax') }}
                                        </th>
                                        <td class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            <x-money amount="{{ $txn->fees }}" currency="sar" convert="true" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                            {{ __('Total') }}
                                        </th>
                                        <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                                            {{ __('Total') }}
                                        </th>
                                        <td class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                            <x-money amount="{{ $txn->actual_amount }}" currency="sar" convert="true" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

</body>

</html>