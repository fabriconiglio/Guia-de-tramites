<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusSlugToAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('area_id');
            $table->string('slug')->unique()->after('nombre');
        });

        $areas = \App\Models\Area::all();
        foreach ($areas as $area) {
            $area->slug = \Illuminate\Support\Str::slug($area->nombre);
            $area->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('slug');
        });
    }
}
