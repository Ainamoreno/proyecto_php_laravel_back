<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function postMessage(Request $request)
    {
        try {

            $party_id = $request->input('party_id');
            $message = $request->input('message');

            $newMessage = new Message();
            $newMessage->party_id = $party_id;
            $newMessage->message = $message;
            $newMessage->date = now()->toDateTimeString();
            $newMessage->save();

            return response([
                'success' => true,
                'message' => 'Mensaje enviado correctamente.',
                'text' => $message
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al enviar el mensaje.'
            ], 500);
        }
    }

    public function updateMessage(Request $request, $id)
    {
        try {
            $messageId = $id;
            $validator = Validator::make($request->all(), [
                'message' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response([
                    'success' => false,
                    'message' => $validator->messages()
                ], 400);
            }

            $message = Message::find($messageId);
            $message->message = $request->input('message');

            if (isset($message)) {
                $message->message = $request->input('message');
            }

            $message->save();

            return response([
                'success' => true,
                'message' => 'Mensaje modificado correctamente.'
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al modificar el mensaje.'
            ], 500);
        }
    }

    public function deleteMessage($id)
    {
        try {
            $messageId = $id;
            $message = Message::query()->find($messageId);

            if(!$message){
                return response([
                    'success' => true,
                    'message' => 'Mensaje no encontrado'
                ], 200);
            }

            $message->delete();

            return response([
                'success' => true,
                'message' => 'Mensaje eliminado correctamente.'
            ], 200);
            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response([
                'success' => false,
                'message' => 'Error al eliminar el mensaje.'
            ], 500);
        }
    }
}
