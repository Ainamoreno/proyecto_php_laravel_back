<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public function getInParty(Request $request, $id)
    {
        // try {
            $playerId = $id;
            $player = Player::find($playerId);
            
            $party = Party::create([
                'play_id' => $request->get('play_id'),
                'name' => $request->get('name'),
                'is_inside' => true
            ]);
            return response([
                'success' => true,
                'message' => 'Has entrado al chat correctamente.'
            ], 200);

            $party->players()->attach($id);

        // } catch (\Throwable $th) {
        //     Log::error($th->getMessage());
        //     return response([
        //         'success' => false,
        //         'message' => 'No has podido acceder al chat.'
        //     ], 500);
        // }
    }

    public function getOutParty(Request $request)
    {
        try {
            $playId = $request->input('play_id');
            $name = $request->input('name');

            $newParty = new Party();
            $newParty->play_id = $playId;
            $newParty->name = $name;
            $newParty->is_inside = false;
            $newParty->save();
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
}
