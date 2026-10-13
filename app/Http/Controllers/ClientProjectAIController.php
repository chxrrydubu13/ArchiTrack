<?php



namespace App\Http\Controllers;



use App\Models\Project;

use App\Models\ProjectAIHistory;

use App\Models\ProjectMessage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;



class ClientProjectAIController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | GENERATE AI IMAGE

    |--------------------------------------------------------------------------

    */



    public function prompt(Request $request, $id)

    {

        $project = Project::where('id', $id)

            ->where('client_id', auth()->id())

            ->firstOrFail();



        $request->validate(

            [

                'prompt' => [

                    'required',

                    'string',

                    'max:3000',

                ],



                'reference_image' => [

                    'nullable',

                    'image',

                    'mimes:jpg,jpeg,png',

                    'max:102400',

                ],



                'parent_history_id' => [

                    'nullable',

                    'integer',

                ],

            ],

            [

                'prompt.required' =>

                    'Please enter your design request.',



                'prompt.max' =>

                    'The design request cannot exceed 3,000 characters.',



                'reference_image.image' =>

                    'The reference file must be a valid image.',



                'reference_image.mimes' =>

                    'Only JPG, JPEG, and PNG images are allowed.',



                'reference_image.max' =>

                    'The reference image cannot be larger than 100 MB.',

            ]

        );



        $apiKey = config('services.openai.key');



        if (!$apiKey) {

            return response()->json([

                'success' => false,

                'message' => 'OpenAI API key is missing.',

            ], 500);

        }



        $imageModel = config(

            'services.openai.image_model',

            'gpt-image-2'

        );



        $clientPrompt = trim(

            $request->prompt

        );



        $referenceImagePath = null;

        $parentHistory = null;

        $editImagePath = null;

        $editImageDisk = null;



        try {



            /*

            |--------------------------------------------------------------------------

            | PREVIOUS AI VERSION

            |--------------------------------------------------------------------------

            */



            if ($request->filled('parent_history_id')) {



                $parentHistory = ProjectAIHistory::where(

                        'id',

                        $request->parent_history_id

                    )

                    ->where(

                        'project_id',

                        $project->id

                    )

                    ->where(

                        'client_id',

                        auth()->id()

                    )

                    ->first();



                if (!$parentHistory) {

                    return response()->json([

                        'success' => false,

                        'message' => 'Previous AI concept was not found.',

                    ], 404);

                }



                $editImagePath =

                    $parentHistory->generated_image_path;



                $editImageDisk =

                    $this->getStoredImageDisk(

                        $editImagePath

                    );



                if (

                    !$editImagePath

                    ||

                    !$editImageDisk

                ) {

                    return response()->json([

                        'success' => false,

                        'message' => 'Previous AI image could not be found.',

                    ], 422);

                }

            }





            /*

            |--------------------------------------------------------------------------

            | SAVE REFERENCE IMAGE

            |--------------------------------------------------------------------------

            |

            | New reference images are saved to PRIVATE local storage.

            |

            */



            if ($request->hasFile('reference_image')) {



                $file =

                    $request->file('reference_image');



                $extension =

                    strtolower(

                        $file->getClientOriginalExtension()

                    );



                $allowedImageExtensions = [

                    'jpg',

                    'jpeg',

                    'png',

                ];





                if (

                    !in_array(

                        $extension,

                        $allowedImageExtensions,

                        true

                    )

                ) {



                    return response()->json([

                        'success' => false,

                        'message' =>

                            'Only JPG, JPEG, and PNG images are allowed.',

                    ], 422);

                }





                $fileName =

                    time()

                    . '_reference_'

                    . Str::random(8)

                    . '.'

                    . $extension;



                $referenceImagePath =

                    $file->storeAs(

                        'project-ai/'

                        . $project->id

                        . '/references',

                        $fileName,

                        'local'

                    );





                if (!$referenceImagePath) {



                    return response()->json([

                        'success' => false,

                        'message' =>

                            'The reference image could not be saved. Please try again.',

                    ], 500);

                }





                /*

                | If there is no previous AI version,

                | use uploaded reference image.

                */



                if (!$editImagePath) {



                    $editImagePath =

                        $referenceImagePath;



                    $editImageDisk =

                        'local';

                }

            }





            /*

            |--------------------------------------------------------------------------

            | VERSION

            |--------------------------------------------------------------------------

            */



            $versionNumber =

                $parentHistory

                    ? ((int) $parentHistory->version_number + 1)

                    : 1;





            /*

            |--------------------------------------------------------------------------

            | IMAGE PROMPT

            |--------------------------------------------------------------------------

            */



            $imagePrompt =

                'Create a realistic architectural or interior design concept. '

                . 'The image is for visual design inspiration only. '

                . 'It is not a construction drawing or technically approved plan. ';



            if ($editImagePath) {



                $imagePrompt .=

                    'Use the provided image as the main reference. '

                    . 'Keep the important existing layout, perspective, '

                    . 'room geometry, windows, doors, and major fixed elements '

                    . 'unless the client specifically asks to change them. ';



            }



            $imagePrompt .=

                "\n\nClient request:\n"

                . $clientPrompt;





            /*

            |--------------------------------------------------------------------------

            | EDIT EXISTING IMAGE

            |--------------------------------------------------------------------------

            */



            if ($editImagePath) {



                if (!$editImageDisk) {



                    $editImageDisk =

                        $this->getStoredImageDisk(

                            $editImagePath

                        );

                }





                if (!$editImageDisk) {



                    if ($referenceImagePath) {



                        Storage::disk('local')

                            ->delete(

                                $referenceImagePath

                            );

                    }



                    return response()->json([

                        'success' => false,

                        'message' => 'Reference image file could not be found.',

                    ], 422);

                }





                $absolutePath =

                    Storage::disk(

                        $editImageDisk

                    )

                        ->path(

                            $editImagePath

                        );





                if (!file_exists($absolutePath)) {



                    if ($referenceImagePath) {



                        Storage::disk('local')

                            ->delete(

                                $referenceImagePath

                            );

                    }



                    return response()->json([

                        'success' => false,

                        'message' => 'Reference image file could not be found.',

                    ], 422);

                }





                $response =

                    Http::withToken($apiKey)

                        ->acceptJson()

                        ->timeout(180)

                        ->attach(

                            'image',

                            file_get_contents(

                                $absolutePath

                            ),

                            basename(

                                $absolutePath

                            )

                        )

                        ->post(

                            'https://api.openai.com/v1/images/edits',

                            [

                                'model' =>

                                    $imageModel,



                                'prompt' =>

                                    $imagePrompt,



                                'size' =>

                                    '1024x1024',



                                'quality' =>

                                    'medium',



                                'output_format' =>

                                    'png',

                            ]

                        );

            }





            /*

            |--------------------------------------------------------------------------

            | GENERATE NEW IMAGE

            |--------------------------------------------------------------------------

            */



            else {



                $response =

                    Http::withToken($apiKey)

                        ->acceptJson()

                        ->timeout(180)

                        ->post(

                            'https://api.openai.com/v1/images/generations',

                            [

                                'model' =>

                                    $imageModel,



                                'prompt' =>

                                    $imagePrompt,



                                'size' =>

                                    '1024x1024',



                                'quality' =>

                                    'medium',



                                'output_format' =>

                                    'png',

                            ]

                        );

            }





            /*

            |--------------------------------------------------------------------------

            | OPENAI ERROR

            |--------------------------------------------------------------------------

            */



            if ($response->failed()) {



                if ($referenceImagePath) {



                    Storage::disk('local')

                        ->delete(

                            $referenceImagePath

                        );

                }



                return response()->json([

                    'success' => false,



                    'message' =>

                        $response->json('error.message')

                        ??

                        'OpenAI could not generate the image.',

                ], $response->status());

            }





            /*

            |--------------------------------------------------------------------------

            | GET GENERATED IMAGE

            |--------------------------------------------------------------------------

            */



            $base64Image =

                $response->json(

                    'data.0.b64_json'

                );



            if (!$base64Image) {



                if ($referenceImagePath) {



                    Storage::disk('local')

                        ->delete(

                            $referenceImagePath

                        );

                }



                return response()->json([

                    'success' => false,

                    'message' => 'OpenAI did not return an image.',

                ], 500);

            }





            $imageData =

                base64_decode(

                    $base64Image,

                    true

                );



            if ($imageData === false) {



                if ($referenceImagePath) {



                    Storage::disk('local')

                        ->delete(

                            $referenceImagePath

                        );

                }



                return response()->json([

                    'success' => false,

                    'message' => 'Generated image could not be processed.',

                ], 500);

            }





            /*

            |--------------------------------------------------------------------------

            | SAVE GENERATED IMAGE

            |--------------------------------------------------------------------------

            |

            | New generated concepts are saved to PRIVATE local storage.

            |

            */



            $generatedFileName =

                time()

                . '_concept_v'

                . $versionNumber

                . '_'

                . Str::random(8)

                . '.png';





            $generatedImagePath =

                'project-ai/'

                . $project->id

                . '/generated/'

                . $generatedFileName;





            $saved =

                Storage::disk('local')

                    ->put(

                        $generatedImagePath,

                        $imageData

                    );





            if (!$saved) {



                if ($referenceImagePath) {



                    Storage::disk('local')

                        ->delete(

                            $referenceImagePath

                        );

                }



                return response()->json([

                    'success' => false,

                    'message' => 'Generated image could not be saved.',

                ], 500);

            }





            /*

            |--------------------------------------------------------------------------

            | SAVE HISTORY

            |--------------------------------------------------------------------------

            */



            $history =

                ProjectAIHistory::create([

                    'project_id' =>

                        $project->id,



                    'client_id' =>

                        auth()->id(),



                    'type' =>

                        $editImagePath

                            ? 'image_edit'

                            : 'image_generation',



                    'prompt' =>

                        $clientPrompt,



                    'result_text' =>

                        'AI Concept Version '

                        . $versionNumber,



                    'image_path' =>

                        $referenceImagePath,



                    'generated_image_path' =>

                        $generatedImagePath,



                    'version_number' =>

                        $versionNumber,



                    'parent_history_id' =>

                        $parentHistory

                            ? $parentHistory->id

                            : null,



                    'sent_to_architect' =>

                        false,

                ]);





            /*

            |--------------------------------------------------------------------------

            | SUCCESS

            |--------------------------------------------------------------------------

            */



            return response()->json([

                'success' =>

                    true,



                'history_id' =>

                    $history->id,



                'prompt' =>

                    $history->prompt,



                'version_number' =>

                    $history->version_number,



                'parent_history_id' =>

                    $history->parent_history_id,



                'reference_image_url' =>

                    $referenceImagePath

                        ? route(

                            'project.ai-history.reference.secure.view',

                            [

                                'projectId' =>

                                    $project->id,



                                'historyId' =>

                                    $history->id,

                            ]

                        )

                        : null,



                'generated_image_url' =>

                    route(

                        'project.ai-history.generated.secure.view',

                        [

                            'projectId' =>

                                $project->id,



                            'historyId' =>

                                $history->id,

                        ]

                    ),



                'sent_to_architect' =>

                    false,

            ]);

        }



        catch (\Throwable $error) {



            report($error);



            if (

                $referenceImagePath

                &&

                Storage::disk('local')

                    ->exists(

                        $referenceImagePath

                    )

            ) {



                Storage::disk('local')

                    ->delete(

                        $referenceImagePath

                    );

            }



            /*

            |--------------------------------------------------------------------------

            | IMPORTANT

            |--------------------------------------------------------------------------

            |

            | Since your project is currently being developed locally,

            | show the real error so we can immediately identify it.

            |

            */



            return response()->json([

                'success' => false,



                'message' =>

                    app()->environment('local')

                        ? $error->getMessage()

                        : 'Something went wrong while generating the AI concept.',

            ], 500);

        }

    }





    /*

    |--------------------------------------------------------------------------

    | SEND AI CONCEPT TO ARCHITECT

    |--------------------------------------------------------------------------

    */



    public function sendToArchitect(

        Request $request,

        $id,

        $historyId

    ) {

        $project =

            Project::where(

                'id',

                $id

            )

            ->where(

                'client_id',

                auth()->id()

            )

            ->firstOrFail();





        $history =

            ProjectAIHistory::where(

                'id',

                $historyId

            )

            ->where(

                'project_id',

                $project->id

            )

            ->where(

                'client_id',

                auth()->id()

            )

            ->firstOrFail();





        $request->validate([

            'message' =>

                'nullable|string|max:5000',

        ]);





        if (!$project->architect_id) {



            return response()->json([

                'success' => false,



                'message' =>

                    'This project has no assigned architect.',

            ], 422);

        }





        $generatedPath =

            $history->generated_image_path;





        $generatedDisk =

            $this->getStoredImageDisk(

                $generatedPath

            );





        if (

            !$generatedPath

            ||

            !$generatedDisk

        ) {



            return response()->json([

                'success' => false,



                'message' =>

                    'Generated AI concept image could not be found.',

            ], 422);

        }





        $clientNote =

            trim(

                (string) $request->input(

                    'message',

                    ''

                )

            );





        /*

        |--------------------------------------------------------------------------

        | MESSAGE

        |--------------------------------------------------------------------------

        */



        $finalMessage =

            "AI Concept / Design Inspiration\n"

            .

            "Version "

            .

            $history->version_number;





        if ($clientNote) {



            $finalMessage .=

                "\n\nClient note:\n"

                .

                $clientNote;

        }





        $finalMessage .=

            "\n\nThis image is a visual concept for discussion "

            .

            "and is not a construction drawing or technically "

            .

            "approved design.";





        /*

        |--------------------------------------------------------------------------

        | CREATE MESSAGE

        |--------------------------------------------------------------------------

        */



        $message =

            ProjectMessage::create([

                'project_id' =>

                    $project->id,



                'sender_id' =>

                    auth()->id(),



                'receiver_id' =>

                    $project->architect_id,



                'message' =>

                    $finalMessage,



                'attachment_path' =>

                    $generatedPath,



                'attachment_name' =>

                    basename(

                        $generatedPath

                    ),



                'attachment_type' =>

                    'png',



                'attachment_size' =>

                    Storage::disk(

                        $generatedDisk

                    )

                        ->size(

                            $generatedPath

                        ),



                'is_read' =>

                    false,

            ]);





        /*

        |--------------------------------------------------------------------------

        | MARK AS SENT

        |--------------------------------------------------------------------------

        */



        $history->update([

            'sent_to_architect' =>

                true,

        ]);





        return response()->json([

            'success' =>

                true,



            'message' =>

                'AI concept sent to your architect.',



            'history_id' =>

                $history->id,



            'sent_to_architect' =>

                true,



            'chat_message' => [



                'id' =>

                    $message->id,



                'message' =>

                    $message->message,



                'attachment_url' =>

                    route(

                        'project.messages.attachments.secure.view',

                        [

                            'projectId' =>

                                $project->id,



                            'messageId' =>

                                $message->id,

                        ]

                    ),



                'attachment_type' =>

                    $message->attachment_type,



                'created_at' =>

                    $message

                        ->created_at

                        ->timezone(

                            'Asia/Manila'

                        )

                        ->format(

                            'M d, g:i A'

                        ),

            ],

        ]);

    }





    /*

    |--------------------------------------------------------------------------

    | FIND AI IMAGE STORAGE DISK

    |--------------------------------------------------------------------------

    |

    | New AI images use private local storage.

    | Older AI images may still exist on the public disk.

    |

    */



    private function getStoredImageDisk(

        $filePath

    ): ?string {



        if (!$filePath) {

            return null;

        }





        if (

            Storage::disk('local')

                ->exists(

                    $filePath

                )

        ) {



            return 'local';

        }





        if (

            Storage::disk('public')

                ->exists(

                    $filePath

                )

        ) {



            return 'public';

        }





        return null;

    }

}
