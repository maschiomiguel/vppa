<?php

use App\Modules\MigrationUtil;
use Modules\Representatives\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->integer('order')->default(9999);
            $table->boolean('active')->default(true);
        });
        Schema::create('questions_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            MigrationUtil::translationsColumns($table, 'questions', 'question_id');
            
            $table->string('question')->nullable();
            $table->mediumtext('answer')->nullable();

            $table->string('title')->nullable();
            $table->string('title_1')->nullable();

            $table->text('text')->nullable();
            $table->text('text_1')->nullable();

            $table->string('link')->nullable();
            $table->string('link_1')->nullable();

            $table->string('text_link')->nullable();
            $table->string('text_link_1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_translations');
        Schema::dropIfExists('questions');
    }
};
