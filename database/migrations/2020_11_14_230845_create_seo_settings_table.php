<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SeoSetting;

class CreateSeoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            # IF Model
            $table->nullableMorphs('model');
            # Else URL
            $table->string('url')->nullable();

            # DEFAULT META #
            $table->string('meta_robots')->nullable()->default(SeoSetting::META_ROBOTS_ALL);

            # OPEN GRAPH #
            $table->string('og_image')->nullable();
            $table->string('og_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_settings');
    }
}
