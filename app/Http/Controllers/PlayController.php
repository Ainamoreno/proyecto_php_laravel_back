<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Play;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlayController extends Controller
{
    public function createGamePlay(Request $request, $id)
    {
        try {
            $gameId = $id;
            $playerId = $request->input('player_id');


            $newGamePlay = new Play();
            $newGamePlay->game_id = $gameId;
            $newGamePlay->player_id = $playerId;

            $newGamePlay->save();

            return response([
                'success' => true,
                'message' => 'Partida creada correctamente.'
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al crear la partida.'
            ], 500);
        }
    }

    public function getGamePlays(Request $request, $id)
    {
        try {
            $playerId = $request->input('player_id');
            $gameplays = Play::query()
                ->where('player_id', $playerId)
                ->where('game_id', $id)
                ->get();

            return response([
                'success' => true,
                'message' => 'Todas las partidas recibidas correctamente',
                'data' => $gameplays
            ], 200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al mostrar las partidas.'
            ], 500);
        }
    }
}
