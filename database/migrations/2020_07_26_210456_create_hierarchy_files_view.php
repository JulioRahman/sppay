<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHierarchyFilesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement(
        //     'CREATE MATERIALIZED VIEW hierarchy_files_view AS (' .
        //         " WITH RECURSIVE files_hierarchy_tree AS ( " .
        //         " SELECT id, file_parent_id, path, name, size, permission, owner_id, is_directory " .
        //         " FROM files " .
        //         " UNION ALL " .

        //         # cte recursive term to retrieve file tree by directory
        //         " SELECT id, file_parent_id, path, name, size, permission, owner_id, is_directory " .
        //         " FROM file_parent_id as f " .
        //         ' INNER JOIN files_hierarchy_tree as v ' .
        //         ' ON f.id = v.file_parent_id '
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement('DROP MATERIALIZED VIEW hierarchy_files_view');
    }
}
