<?php

namespace App\FileStorage\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait hasFiles
{
    /**
     * similar to unix ls command, is to list file.
     * 
     * @return Illuminate\Support\Collection
     */
    public function listDirectory($all = false)
    {
        if ($this->hasFile(static::class, $this->id)) {
            return $this->files();
        }
    }

    /**
     * 
     */
    public function hasFile(string $modelName, int $modelId, int $directoryId = null)
    {
        # if the file id parameter is null, it will be assumed as Model home directory
        if (is_null($directoryId)) {
        }
    }

    /**
     * 
     */
    public function files(): MorphMany
    {
        return $this->morphMany('model_has_files', 'model');
    }
}
