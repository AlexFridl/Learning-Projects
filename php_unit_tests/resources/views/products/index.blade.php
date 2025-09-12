<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-4 ">NAME</th>
                                <th class="col-4 ">PRICE (DIN)</th>
                                <th class="col-4 ">PRICE (EUR)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @forelse ($products as $product)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray">
                                        {{ $product->price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray">
                                        {{ $product->price_eur }}
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white">
                                    <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray">
                                        {{ __('No products found') }}
                                    </td>
                                </tr>

                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>




