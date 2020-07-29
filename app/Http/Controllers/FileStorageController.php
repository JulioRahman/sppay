<?php

namespace App\Http\Controllers;

use App\FileStorage\Models\File as FileSystem;
use Illuminate\Contracts\Filesystem\Filesystem as ContractsFilesystemFilesystem;
use Illuminate\Filesystem\Filesystem as FilesystemFilesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $request->validate([
            'sortKey' => 'nullable|string',
            'sortOrder' => 'required_with:sortKey'
        ]);

        # if id is null retrieve root_files
        $id = $id ?? FileSystem::where('path', '/root_files')->first()->id;

        $files = FileSystem::where('file_parent_id', $id)
            ->get();

        return response()->json([
            'success' => 'OK',
            'results' => $files
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required_if:is_directory,false|file',
            'permission' => 'nullable',
            'file_parent_id' => 'nullable|uuid',
            'is_directory' => 'required|in:true,false',
            'name' => 'required'
        ]);

        // resource owner automatically retrived from user who makes the request
        $owner = $request->user();

        // store records
        return response()->json([
            'success' => 'OK',
            'result' => FileSystem::create([
                'permission' => $request->input('permission', '777'),
                'is_directory' => $request->is_directory === 'true' ? true : false,
                'name' => $request->name,
                'file_parent_id' => $request->file_parent_id,
                'owner_id' => $owner->id
            ], $request->file('file'))
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return response()->json([
            'success' => 'OK',
            'result' => $tree
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
