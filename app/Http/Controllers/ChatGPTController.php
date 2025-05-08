<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatGPTController extends Controller
{
    public function askChatGPT(Request $request)
    {
        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un asistente virtual de DealBuy, un e-commerce especializado en tecnología, productos electrónicos y gadgets. Solo estás programado para responder preguntas sobre productos tecnológicos, comparativas, características, precios, recomendaciones y funcionamiento de dispositivos. Si te hacen una pregunta fuera de ese contexto, responde: "No estoy programado para responderte eso".'],
                    ['role' => 'user', 'content' => $request->input('prompt')],  // Aquí se toma 'prompt'
                ],
                'max_tokens' => 100,
            ],
        ]);
        $body = json_decode($response->getBody(), true);
        return response()->json(['response' => $body['choices'][0]['message']['content']]);
    }
}
