<?php

use App\FileStorage\Models\File;
use App\User;
use Illuminate\Database\Seeder;

class FileStorageSeeder extends Seeder
{
    /**
     * 
     */
    protected $hierarchyFiles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->prepareSeeds();

        # execute storing to db

        foreach ($this->hierarchyFiles['files'] as $folder => $files) {
        }
    }

    /**
     * 
     */
    protected function prepareSeeds()
    {
        # prepare owner of files and hierarchy of the file
        # file associative array on 'files' key
        # the key indicates the folder/directory the value indicates
        # the file in it 

        $this->hierarchyFiles = [
            'user' => User::find(1),
            'files' => [
                'File Pribadi' => [
                    'Foto Pribadi' => [
                        'app/seeds/my_girlfriend.jpg',
                        'app/seeds/she_loves_me.jpg'
                    ],
                    'app/seeds/excel_pribadi.xlsx'
                ]
            ]
        ];
    }
}
