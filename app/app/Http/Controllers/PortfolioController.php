<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class PortfolioController extends Controller
{
  public function index(Request $request)
  {
    $userEmail = $request->user()->email;
    $portfolios = Portfolio::where('email', $userEmail)->get();

    $client = new Client();
    $apiKey = env('FINNHUB_API_KEY');
    $updatedPortfolios = $portfolios->map(function ($stock) use ($client, $apiKey) {
      $ticker = $stock->ticker;

      try {
        $response = $client->get("https://finnhub.io/api/v1/quote", [
          'query' => [
            'symbol' => $ticker,
            'token' => $apiKey,
          ],
        ]);
        $data = json_decode($response->getBody(), true);
        $currentPrice = $data['c'];

        $stock->current_price = $currentPrice;
      } catch (\Exception $e) {
        $stock->current_price = null;
      }

      return $stock;
    });

    return $updatedPortfolios;
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'stock_name' => 'required|string|max:255',
      'ticker' => 'required|string|max:255',
      'stock_price' => 'required|numeric|min:0',
      'stock_quantity' => 'required|integer|min:1',
    ]);

    $userEmail = $request->user()->email;

    Portfolio::create([
      'email' => $userEmail,
      'stock_name' => $validated['stock_name'],
      'ticker' => $validated['ticker'],
      'stock_price' => $validated['stock_price'],
      'stock_quantity' => $validated['stock_quantity'],
    ]);

    return response()->json([
      'message' => 'Portfolio saved successfully!',
    ], 201);
  }

  public function update(Request $request, $ticker)
  {
    $validated = $request->validate([
      'stock_price' => 'required|numeric|min:0',
      'stock_quantity' => 'required|integer|min:1',
    ]);

    try {
      $portfolio = Portfolio::where('ticker', $ticker)->firstOrFail();
      $portfolio->update($validated);

      return response()->json([
        'message' => 'Portfolio updated successfully!',
        'portfolio' => $portfolio,
      ], 200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Portfolio not found or update failed.'], 404);
    }
  }

  public function destroy($ticker)
  {
    try {
      $portfolio = Portfolio::where('ticker', $ticker)->firstOrFail();
      $portfolio->delete();

      return response()->json([
        'message' => 'Portfolio deleted successfully!',
      ], 200);
    } catch (\Exception $e) {
      Log::error('Error deleting portfolio: ', ['ticker' => $ticker, 'error' => $e->getMessage()]);
      return response()->json(['message' => 'Portfolio not found or delete failed.'], 404);
    }
  }

  public function getMonthlyStockData(Request $request)
  {
    $userEmail = $request->user()->email;
    $oneMonthAgo = now()->subMonth();

    $portfolios = Portfolio::where('email', $userEmail)
      ->where('created_at', '>=', $oneMonthAgo)
      ->orderBy('stock_quantity', 'desc')
      ->select(['ticker', 'stock_price', 'stock_quantity'])
      ->get();

    $client = new Client();
    $apiKey = env('FINNHUB_API_KEY');
    $updatedPortfolios = $portfolios->map(function ($stock) use ($client, $apiKey) {
      $ticker = $stock->ticker;

      try {
        $response = $client->get("https://finnhub.io/api/v1/quote", [
          'query' => [
            'symbol' => $ticker,
            'token' => $apiKey,
          ],
        ]);
        $data = json_decode($response->getBody(), true);
        $currentPrice = $data['c'];
        $purchasePrice = $stock->stock_price;
        $profit = (($currentPrice - $purchasePrice) / $purchasePrice) * 100;
        $stock->profit = round($profit, 2);
      } catch (\Exception $e) {
        $stock->profit = null;
      }
      return $stock;
    });

    return $updatedPortfolios;
    // return $portfolios;
  }
}
