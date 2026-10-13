<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ProjectActivityNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $type;
    protected $projectId;
    protected $url;

    /*
    |--------------------------------------------------------------------------
    | CONSTRUCTOR
    |--------------------------------------------------------------------------
    */

    public function __construct(
        $title,
        $message,
        $type = 'general',
        $projectId = null,
        $url = null
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->projectId = $projectId;
        $this->url = $url;
    }


    /*
    |--------------------------------------------------------------------------
    | DELIVERY CHANNEL
    |--------------------------------------------------------------------------
    */

    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | DATABASE NOTIFICATION DATA
    |--------------------------------------------------------------------------
    */

    public function toDatabase(object $notifiable): array
    {
        return [

            'title' =>
                $this->title,

            'message' =>
                $this->message,

            'type' =>
                $this->type,

            'project_id' =>
                $this->projectId,

            'url' =>
                $this->url,

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | ARRAY REPRESENTATION
    |--------------------------------------------------------------------------
    */

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase(
            $notifiable
        );
    }
}