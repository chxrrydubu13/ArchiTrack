<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class OpenAIService
{
    private string $apiKey;
    private string $model;

    public function __construct()
    {
        $this->apiKey = (string) config('services.openai.key');

        $this->model = (string) config(
            'services.openai.model',
            'gpt-6-luna'
        );
    }

    public function testConnection(): string
    {
        $this->ensureApiKey();

        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->timeout(60)
            ->post('https://api.openai.com/v1/responses', [
                'model' => $this->model,
                'input' => 'Reply only with: ArchiTrack AI connected successfully.',
            ]);

        if ($response->failed()) {
            throw new Exception(
                $response->json('error.message')
                ?? 'OpenAI request failed.'
            );
        }

        $text = $this->extractOutputText($response->json());

        return $text ?: 'No response received.';
    }

    public function organizeRevisionFeedback(string $feedback): array
    {
        $this->ensureApiKey();

        $systemPrompt = <<<'PROMPT'
You are an AI assistant inside ArchiTrack,
an architectural project management system.

Your task is to organize client revision feedback.

Do not invent architectural changes that the client did not request.
Keep the client's original meaning and intention.
Use only categories that are relevant.

Possible categories:
- Space Planning
- Layout
- Dimensions
- Materials
- Colors and Finishes
- Lighting
- Furniture
- Doors and Windows
- Exterior
- Interior
- Landscape
- Electrical
- Plumbing
- Other

Make each revision instruction clear and concise.

Do not give architectural, engineering, structural, or safety approval.

Return ONLY valid JSON using this exact structure:

{
    "summary": "Short summary of the client's requested changes",
    "categories": [
        {
            "category": "Category name",
            "items": [
                "Revision request 1",
                "Revision request 2"
            ]
        }
    ]
}
PROMPT;

        $response = Http::withToken($this->apiKey)
            ->acceptJson()
            ->timeout(60)
            ->post('https://api.openai.com/v1/responses', [
                'model' => $this->model,
                'input' => [
                    [
                        'role' => 'system',
                        'content' => [
                            [
                                'type' => 'input_text',
                                'text' => $systemPrompt,
                            ],
                        ],
                    ],
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'input_text',
                                'text' => $feedback,
                            ],
                        ],
                    ],
                ],
            ]);

        if ($response->failed()) {
            throw new Exception(
                $response->json('error.message')
                ?? 'Unable to process AI revision feedback.'
            );
        }

        $outputText = $this->extractOutputText($response->json());

        if (!$outputText) {
            throw new Exception('OpenAI returned an empty response.');
        }

        $cleanText = trim($outputText);
        $cleanText = preg_replace('/^```json\s*/i', '', $cleanText);
        $cleanText = preg_replace('/\s*```$/', '', $cleanText);

        $result = json_decode(trim($cleanText), true);

        if (!is_array($result)) {
            throw new Exception('Unable to read the AI response.');
        }

        if (
            !isset($result['summary'])
            || !isset($result['categories'])
            || !is_array($result['categories'])
        ) {
            throw new Exception('AI response has an invalid format.');
        }

        return $result;
    }

    private function ensureApiKey(): void
    {
        if (!$this->apiKey) {
            throw new Exception('OpenAI API key is not configured.');
        }
    }

    private function extractOutputText(array $data): ?string
    {
        foreach (($data['output'] ?? []) as $output) {
            foreach (($output['content'] ?? []) as $content) {
                if (
                    isset($content['text'])
                    && in_array(
                        $content['type'] ?? '',
                        ['output_text', 'text'],
                        true
                    )
                ) {
                    return $content['text'];
                }
            }
        }

        return null;
    }
}
