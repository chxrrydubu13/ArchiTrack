<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientRevisionAIController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STRUCTURE REVISION WITH AI
    |--------------------------------------------------------------------------
    */

    public function structure(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | MAKE SURE PROJECT BELONGS TO CLIENT
        |--------------------------------------------------------------------------
        */

        $project = Project::where('id', $id)
            ->where('client_id', auth()->id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

            'revision_category' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CHECK API KEY
        |--------------------------------------------------------------------------
        */

        $apiKey = config('services.openai.key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'OpenAI API key is not configured.',
            ], 500);
        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT CATEGORY
        |--------------------------------------------------------------------------
        */

        $category = !empty($validated['revision_category'])
            ? trim($validated['revision_category'])
            : 'Not selected';


        /*
        |--------------------------------------------------------------------------
        | BUILD AI INSTRUCTION
        |--------------------------------------------------------------------------
        */

        $prompt =
            "You are an architectural revision assistant inside a project management system.

Your job is to organize a client's revision feedback so that a professional architect can understand the request clearly.

Do not invent requirements that the client did not provide.

You may clarify the wording and identify practical architectural considerations, but do not make final architectural decisions.

Use simple and professional language.

Choose the most appropriate category from this list only:

- Layout
- Exterior
- Interior
- Materials
- Furniture
- Lighting
- Other

If the client already selected a suitable category, keep it.

Return your response in exactly this format:

CATEGORY: [category]

AREA:
[room, space, element, or location involved]

REQUESTED CHANGE:
[clear explanation of what the client wants changed]

PREFERRED RESULT:
[what result the client appears to want]

ARCHITECT CONSIDERATIONS:
[short practical points the architect may need to review]

Do not add any introduction or closing message.

Project:
" . $project->project_name . "

Revision Title:
" . trim($validated['title']) . "

Client Selected Category:
" . $category . "

Original Client Feedback:
" . trim($validated['description']);


        /*
        |--------------------------------------------------------------------------
        | CALL OPENAI RESPONSES API
        |--------------------------------------------------------------------------
        */

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->asJson()
                ->timeout(90)
                ->post(
                    'https://api.openai.com/v1/responses',
                    [
                        'model' => config(
                            'services.openai.model',
                            'gpt-5.6-luna'
                        ),

                        'input' => [
                            [
                                'role' => 'user',

                                'content' => [
                                    [
                                        'type' => 'input_text',
                                        'text' => $prompt,
                                    ],
                                ],
                            ],
                        ],
                    ]
                );


            /*
            |--------------------------------------------------------------------------
            | API ERROR
            |--------------------------------------------------------------------------
            */

            if ($response->failed()) {
                return response()->json([
                    'success' => false,

                    'message' =>
                        $response->json('error.message')
                        ?? 'Unable to structure the revision with AI.',
                ], 500);
            }


            $data = $response->json();


            /*
            |--------------------------------------------------------------------------
            | GET AI TEXT
            |--------------------------------------------------------------------------
            */

            $resultText = $this->getResponseText($data);

            if (!$resultText) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI returned an empty response.',
                ], 500);
            }


            /*
            |--------------------------------------------------------------------------
            | GET CATEGORY FROM AI RESULT
            |--------------------------------------------------------------------------
            */

            $aiCategory = $this->getCategoryFromResult(
                $resultText
            );


            /*
            |--------------------------------------------------------------------------
            | REMOVE CATEGORY LINE FROM EDITABLE FEEDBACK
            |--------------------------------------------------------------------------
            |
            | The category is already placed in the category dropdown.
            | We remove only the CATEGORY line from the editable AI feedback.
            |
            */

            $structuredFeedback = preg_replace(
                '/^\s*CATEGORY:\s*.+(?:\R+|$)/i',
                '',
                trim($resultText),
                1
            );

            $structuredFeedback = trim(
                $structuredFeedback ?? $resultText
            );


            /*
            |--------------------------------------------------------------------------
            | MAKE SURE WE ACTUALLY HAVE STRUCTURED FEEDBACK
            |--------------------------------------------------------------------------
            */

            if ($structuredFeedback === '') {
                return response()->json([
                    'success' => false,
                    'message' => 'AI returned an incomplete structured revision.',
                ], 500);
            }


            /*
            |--------------------------------------------------------------------------
            | RETURN RESULT TO CLIENT
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'category' => $aiCategory,
                'structured_feedback' => $structuredFeedback,
            ]);

        } catch (\Throwable $error) {
            report($error);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while contacting the AI assistant.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GET CATEGORY FROM AI RESULT
    |--------------------------------------------------------------------------
    */

    private function getCategoryFromResult(
        string $result
    ): string {
        $allowedCategories = [
            'Layout',
            'Exterior',
            'Interior',
            'Materials',
            'Furniture',
            'Lighting',
            'Other',
        ];


        /*
        |--------------------------------------------------------------------------
        | FIND CATEGORY LINE
        |--------------------------------------------------------------------------
        */

        if (
            preg_match(
                '/^\s*CATEGORY:\s*(.+?)\s*$/im',
                $result,
                $matches
            )
        ) {
            $category = trim($matches[1]);

            /*
            |--------------------------------------------------------------------------
            | REMOVE POSSIBLE MARKDOWN FORMATTING
            |--------------------------------------------------------------------------
            */

            $category = trim(
                $category,
                " \t\n\r\0\x0B*#_-"
            );


            foreach (
                $allowedCategories
                as $allowedCategory
            ) {
                if (
                    strcasecmp(
                        $category,
                        $allowedCategory
                    ) === 0
                ) {
                    return $allowedCategory;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FALLBACK
        |--------------------------------------------------------------------------
        */

        return 'Other';
    }


    /*
    |--------------------------------------------------------------------------
    | READ RESPONSES API TEXT
    |--------------------------------------------------------------------------
    */

    private function getResponseText(
        array $data
    ): ?string {

        /*
        |--------------------------------------------------------------------------
        | OUTPUT_TEXT HELPER FIELD
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['output_text'])
            &&
            is_string($data['output_text'])
            &&
            trim($data['output_text']) !== ''
        ) {
            return trim(
                $data['output_text']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FALLBACK: LOOP THROUGH OUTPUT
        |--------------------------------------------------------------------------
        */

        foreach (
            $data['output'] ?? []
            as $output
        ) {
            foreach (
                $output['content'] ?? []
                as $content
            ) {
                if (
                    isset($content['text'])
                    &&
                    is_string($content['text'])
                    &&
                    trim($content['text']) !== ''
                ) {
                    return trim(
                        $content['text']
                    );
                }
            }
        }


        return null;
    }
}