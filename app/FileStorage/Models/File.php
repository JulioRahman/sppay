<?php

namespace App\FileStorage\Models;

use Exception;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class File extends Model
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * 
     */
    public static function create($attributes, UploadedFile $file = null)
    {
        return self::createInstance(
            self::createAttributes($attributes, $file)
        )
            ->setFile($file)
            ->createPhysical();
    }

    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    public function createPhysical()
    {
        if ($this->is_directory) {
            Storage::makeDirectory($this->path);

            return $this;
        }
        $filePath = explode('/', str_replace('//', '/', $this->path));
        $fileName = $filePath[count($filePath) - 1];
        unset($filePath[count($filePath) - 1]);

        $this->file->storeAs(implode('/', $filePath), $fileName);
        // Storage::move($this->file->getPath(), $this->path);
        // dd($this->file);

        // Storage::move
    }

    private static function createAttributes($attributes, $file)
    {

        if (!isset($attributes['file_parent_id'])) {
            $attributes['file_parent_id'] = File::where('path', '/root_files')->firstOrFail()->id;
        }

        $attributes['path'] = self::createPath(
            $attributes['file_parent_id'],
            method_exists($file, 'getClientOriginalName') ?
                $attributes['name'] . '.' . $file->getClientOriginalExtension()
                : $attributes['name']
        );

        if (!is_null($file)) {
            $attributes['size'] = $file->getSize();
            $attributes['name'] = $attributes['name'] . '.' . $file->getClientOriginalExtension();
        }
        if (!isset($attributes['owner_id'])) {
            $attributes['owner_id'] = Auth::id();
        }

        return $attributes;
    }

    private static function createInstance($attributes)
    {
        $instance = new self();

        foreach ($attributes as $key => $value) {
            $instance->{$key} = $value;
        }
        if ($instance->save()) {
            return $instance;
        } else {
            throw new ModelNotFoundException('failed to store file, please try again');
        }
    }

    protected function createDirectory($path)
    {
        return Storage::makeDirectory($path);
    }

    protected static function createPath(string $id = null, $file_name = '')
    {
        $directory = File::find($id);

        # if the request is a file. Must hash the name of the file
        if (count($file = explode('.', $file_name)) > 1) {
            $file_name = hash('sha256', $file[0]) . '.' . $file[1];
        }

        // if is not inside directory
        if (is_null($directory)) {
            return $file_name;
        }
        return str_replace('//', '/', $directory->path . '/' . $file_name);
    }

    protected function moveUploadedFile($file)
    {
    }
}
