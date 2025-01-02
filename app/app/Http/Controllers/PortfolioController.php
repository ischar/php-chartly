<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


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

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'stock_name' => 'required|string|max:255',
      'stock_price' => 'required|numeric|min:0',
      'ticker' => 'required|string|max:255',
      'stock_quantity' => 'required|integer|min:1',
    ]);

    try {
      $portfolio = Portfolio::findOrFail($id);
      $portfolio->update($validated);

      return response()->json([
        'message' => 'Portfolio updated successfully!',
        'portfolio' => $portfolio,
      ], 200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Portfolio not found or update failed.'], 404);
    }
  }

  public function destroy($id)
  {
    try {
      $portfolio = Portfolio::findOrFail($id);
      $portfolio->delete();

      return response()->json([
        'message' => 'Portfolio deleted successfully!',
      ], 200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Portfolio not found or delete failed.'], 404);
    }
  }
}
