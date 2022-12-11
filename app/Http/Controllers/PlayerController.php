<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    public function updatePlayer(Request $request, $id)
    {
        try {
            $playerId = $id;
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'steamUsername' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $player = Player::find($playerId);
            $player->name = $request->input('name');
            $player->steamUsername = $request->input('steamUsername');

            if (isset($player)) {
                $player->name = $request->input('name');
            }
            if (isset($player)) {
                $player->steamUsername = $request->input('steamUsername');
            }

            $player->save();

            return response([
                'success' => true,
                'message' => 'Datos del jugador modificados correctamente.'
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al modificar los datos del jugador.'
            ], 500);
        }
    }
}
