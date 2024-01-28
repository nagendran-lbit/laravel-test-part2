<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;

class SalesController extends Controller
{
    public function saveSales(Request $request)
    {
        // Validate the request data
        $request->validate([
            'quantity' => 'required|numeric|min:0',
            'unit_cost' => 'required',
        ]);

        // Create a new sale record
        $sale = new Sale();
        $sale->product = $request->product;
        $sale->quantity = $request->quantity;
        $sale->unit_cost = $request->unit_cost;
        $sale->selling_price = $request->selling_price;
        $sale->save();

        return redirect()->back()->with('success', 'Sale recorded successfully.');
    }

    public function showSalesView()
    {
        $sales = Sale::all(); // Fetch all sales records from the database
        foreach ($sales as &$sale) {
            $currency = new Currency('GBP');
            $sale->unit_cost = new Money($sale->unit_cost * 100, $currency); // Convert to pennies
            $sale->selling_price = new Money($sale->selling_price * 100, $currency); // Convert to pennies
        }    
        return $sales; 
    }

}
