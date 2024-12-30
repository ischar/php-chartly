<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchlistStock;
use GuzzleHttp\Client;

class WatchlistController extends Controller
{
  public function index(Request $request)
  {
    $userEmail = $request->user()->email;
    $watchlists = WatchlistStock::where('email', $userEmail)->get();

    $client = new Client();
    $apiKey = env('FINNHUB_API_KEY');
    $updatedWatchlists = $watchlists->map(function ($stock) use ($client, $apiKey) {
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
        $previousClose = $data['pc'];
        $change = null;

        if ($previousClose > 0) {
          $change = (($currentPrice - $previousClose) / $previousClose) * 100;
        }

        $stock->current_price = $currentPrice;
        $stock->change = $change;
      } catch (\Exception $e) {
        $stock->current_price = null;
        $stock->change = null;
      }

      return $stock;
    });


    return view('watchlist', ['watchlists' => $updatedWatchlists]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'stock_name' => 'required|string|max:255',
      'ticker' => 'required|string|max:255',
    ]);

    $userEmail = $request->user()->email;

    WatchlistStock::create([
      'email' => $userEmail,
      'stock_name' => $validated['stock_name'],
      'ticker' => $validated['ticker'],
    ]);

    return response()->json(['message' => 'Stock added to watchlist'], 201);
  }

  public function destroy($id)
  {
    $watchlist = WatchlistStock::findOrFail($id);
    $watchlist->delete();

    return response()->json(['message' => 'Stock removed from watchlist'], 200);
  }
}
