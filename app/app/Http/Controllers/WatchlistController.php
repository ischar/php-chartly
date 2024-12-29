<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchlistStock;

class WatchlistController extends Controller
{
  public function index(Request $request)
  {
    $userEmail = $request->user()->email;
    $watchlists = WatchlistStock::where('email', $userEmail)->get();
    
    return view('watchlist', ['watchlists' => $watchlists]);
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

  public function destroy($id) {
      $watchlist = WatchlistStock::findOrFail($id);
      $watchlist->delete();

      return response()->json(['message' => 'Stock removed from watchlist'], 200);
  }
}
