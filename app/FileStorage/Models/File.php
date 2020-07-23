<?php

namespace App\FileStorage\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class File extends Model
{
    protected $fillable = [
        'name', 'path', 'is_directory', 'owner_id',
        'permission', 'file_parent_id', 'size'
    ];

    protected const ROOT_PATH = 'app/root';

    /**
     * 
     */
    public function createPyshical($attributes)
    {
        $attributes = collect(
            $attributes ?? $this->attributes
        )
            ->toArray();
    }

    /**
     * 
     * 
     */
    public static function create(array $attributes)
    {
        $instance = (new self)->fill($attributes);
        if ($instance->save()) {

            if ($instance->is_directory) {
                Storage::makeDirectory(storage_path($instance->path));
            } else {
                Storage::move($instance->path, storage_path(self::ROOT_PATH."/$instance->owner_id/"));
            }
        }

        return $instance;
    }
}
