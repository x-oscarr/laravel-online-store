<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SeoSetting;

class CreateSeoSettingTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_setting_trans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seo_setting_id')->constrained()->onDelete('cascade');
            $table->string('locale');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            # DEFAULT META #
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_robots')->nullable()->default(SeoSetting::META_ROBOTS_ALL);
            # OPEN GRAPH #
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_site_name')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo_setting_trans');
    }
}
