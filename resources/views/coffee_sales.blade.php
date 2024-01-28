<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <script src="{{ route('jquery') }}"></script>

    <script>
        $(document).ready(function(){
            // Function to calculate selling price
            function calculateSellingPrice() {
                var quantity = parseFloat($('#quantity').val());
                var unitCost = parseFloat($('#unit_cost').val());
                var profitMargin = 0.15;
                var shippingCost = 10;

                // Calculate the cost
                var cost = quantity * unitCost;

                // Check if any field has a negative value
                if (quantity < 0 || unitCost < 0 || sellingPrice < 0) {
                    $('#calculate_button').prop('disabled', true);
                    $('#quantity').val(0);
                    $('#unit_cost').val(0);
                } else {
                    $('#calculate_button').prop('disabled', false);

                    // Calculate the selling price
                    var sellingPrice = (cost / (1 - profitMargin)) + shippingCost;

                    // Display the calculated selling price
                    $('#selling_price').val(sellingPrice.toFixed(2));
                }                
            }

            // Trigger calculation when quantity or unit cost changes
            $('#quantity, #unit_cost').change(function() {
                calculateSellingPrice();
            });
        });
    </script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="sales_form" action="{{ route('save.sales') }}" method="post" class="flex flex-wrap">
                        @csrf
                        <div class="max-w-md mr-2 mb-4">
                            <label for="quantity" class="block">Product</label>
                            <select name="product" id="product" class="form-control">
                                <option value="Gold coffee">Gold coffee</option>
                                <option value="Arabic coffee">Arabic coffee</option>                                
                            </select>
                        </div>
                        <div class="max-w-md mr-2 mb-4"> 
                            <label for="quantity" class="block">Quantity</label>
                            <input type="number" name="quantity" id="quantity" required class="block">
                        </div>
                        <div class="max-w-md mr-2 mb-4">
                            <label for="unit_cost" class="block">Unit Cost (£)</label>
                            <input type="number" required step="any" name="unit_cost" id="unit_cost" class="block">
                        </div>
                        <div class="max-w-md mr-2 mb-4">
                            <label for="selling_price" class="block">Selling Price</label>
                            <input type="number" name="selling_price" readonly  id="selling_price" required class="block">
                        </div>
                        <button type="submit" id="calculate_button" class="ml-2">Record Sale</button>
                    </form>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Previous Sales</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Unit Cost</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Selling Price</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Sold at</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($sales->isNotEmpty())
                            @foreach($sales as $sale)
                            <tr class="bg-white">
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{ $sale->product }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{ $sale->quantity }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $sale->unit_cost }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{ $sale->selling_price }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{ $sale->created_at }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">No sales records found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
