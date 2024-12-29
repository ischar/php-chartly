<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Http;
use App\Models\NasdaqStock;

class NasdaqController extends Controller
{
    public function getNasdaqData()
    {
        $apiKey = env('ALPHA_VANTAGE_API_KEY'); 
        $symbol = 'QQQ'; 
        $url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['Global Quote'])) {
                $currentPrice = $data['Global Quote']['05. price'];
                $changePercent = $data['Global Quote']['10. change percent'];

                return response()->json([
                    'currentPrice' => $currentPrice,
                    'changePercent' => $changePercent,
                ]);
            }

            return response()->json(['error' => 'No data found'], 404);
        }

        return response()->json(['error' => 'Unable to fetch data'], 500);
    }

    public function getAllNasdaqStocks()
    {
        $stocks = NasdaqStock::all();
        return response()->json($stocks);
    }
}
