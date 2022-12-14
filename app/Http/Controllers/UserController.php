<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateUser(Request $request)
    {
        try {
            $userId = auth()->user()->id;

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

            $user = User::find($userId);
            $user->name = $request->input('name');
            $user->steamUsername = $request->input('steamUsername');

            if (isset($user)) {
                $user->name = $request->input('name');
            }
            if (isset($user)) {
                $user->steamUsername = $request->input('steamUsername');
            }

            $user->save();

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
