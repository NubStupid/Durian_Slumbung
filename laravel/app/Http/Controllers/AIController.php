<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use OpenAI;

class AIController extends Controller
{
    //
    public function viewChat()
    {
        $apiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($apiKey);
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello!'],
            ],
        ]);

        $content = $result->choices[0]->message->content;
        $content = view('prompt',['content'=>$content]);
        return view('masterAI', ['content' => $content]);
    }
    public function promptChat(Request $request)
    {
        // $apiKey = env('OPENAI_API_KEY');
        // $client = OpenAI::client($apiKey);
        // $prompt = $request->input('data');
        // if ($prompt === null) {
        //     return response()->json(['error' => 'Prompt is required.'], 400);
        // }
        // try {
        //     $result = $client->completions()->create([
        //         'model' => 'gpt-3.5-turbo',
        //         'prompt' => $prompt,
        //         'max_tokens' => 10,
        //     ]);
        //     $content = $result->choices[0]->message->content;
        //     $content = view('prompt',['content'=>$content]);
        //     return $content;
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
        $apiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($apiKey);
        $result = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $request->input('data')],
            ],
        ]);

        $content = $result->choices[0]->message->content;
        $content = view('prompt',['content'=>$content]);
        return $content;
    }
}
