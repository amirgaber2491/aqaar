<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('slug', '50')->nullable();
            $table->string('namesetting', '50')->nullable();
            $table->text('value')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->timestamps();
        });
        SiteSetting::create([
            'slug'=>'اسم الموقع',
            'namesetting'=>'siteName',
            'value'=>'موقع العقارات الاول فى الشرق الاوسط'
        ]);
        SiteSetting::create([
            'slug'=>'الموبايل',
            'namesetting'=>'mobile',
        ]);
        SiteSetting::create([
            'slug'=>'ايميل الموقع',
            'namesetting'=>'email',
            'type'=>'0'
        ]);
        SiteSetting::create([
            'slug'=>'الفيس',
            'namesetting'=>'facebook',
        ]);
        SiteSetting::create([
            'slug'=>'التويتر',
            'namesetting'=>'twitter',
        ]);
        SiteSetting::create([
            'slug'=>'اليوتيوب',
            'namesetting'=>'youtube',
        ]);
        SiteSetting::create([
            'slug'=>'العنوان',
            'namesetting'=>'address',
        ]);
        SiteSetting::create([
            'slug'=>'الكلمات الدلاليه',
            'namesetting'=>'keywords',
            'type'=>'1',
        ]);
        SiteSetting::create([
            'slug'=>'وصف الموقع',
            'namesetting'=>'dis',
            'type'=>'1',
        ]);
        SiteSetting::create([
            'slug'=>'صوره الموقع',
            'namesetting'=>'image',
            'type'=>'2'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
