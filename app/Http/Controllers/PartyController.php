<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public function getInParty(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            
            $party = Party::create([
                'game_id' => $request->get('game_id'),
                'user_id' => $userId,
                'name' => $request->get('name'),
                'is_inside' => true
            ]);

            $party->users()->attach($userId);

            return response([
                'success' => true,
                'message' => 'Has entrado al chat correctamente.'
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No has podido acceder al chat.'
            ], 500);
        }
    }

    public function getOutParty(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            
            $party = Party::create([
                'game_id' => $request->get('game_id'),
                'user_id' => $userId,
                'name' => $request->get('name'),
                'is_inside' => false
            ]);

            $party->users()->attach($userId);

            return response([
                'success' => true,
                'message' => 'Has salido del chat correctamente.'
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'No has podido salir del chat.'
            ], 500);
        }
    }

    public function createParty(Request $request, $id)
    {
        try {
            $gameId = $id;
            $userId = auth()->user()->id;
            $name = $request->input('name');
            $isInside = $request->input('is_inside');

            $newGamePlay = new Party();
            $newGamePlay->game_id = $gameId;
            $newGamePlay->user_id = $userId;
            $newGamePlay->name = $name;
            $newGamePlay->is_inside = $isInside;

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

    public function getParties($id)
    {
        try {
            $userId = auth()->user()->id;
            $gameplays = Party::query()
                ->where('user_id', $userId)
                ->where('game_id', $id)
                ->join('games', 'games.id', '=', 'parties.game_id')
                ->select('games.title AS nombre_videojuego', 'parties.*')
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
