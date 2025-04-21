<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{
    public function chat(Request $request)
    {
        // Validamos que venga el mensaje
        $request->validate([
            'message' => 'required|string',
        ]);

        // Hacemos la petición POST a la API de OpenAI
        $response = Http::withToken(config('services.openai.api_key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $request->input('message')],
                ],
            ]);

        // Devolvemos la respuesta JSON
        return response()->json($response->json());
    }
}
