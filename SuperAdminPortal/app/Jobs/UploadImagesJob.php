<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManagerStatic as Image;

class UploadImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $folder;
    private $filename;
    private $column_to_update;
    private $filePath;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $column_to_update, $filePath, $folder, $filename)
    {
        $this->model = $model;
        $this->folder = $folder;
        $this->filename = $filename;
        $this->column_to_update = $column_to_update;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filePath = request()->uploaded_image->storeOnCloudinaryAs($this->folder, $this->filename)->getPath();
        $this->model[$this->column_to_update] = $filePath;
        $this->model->save();
    }
}
