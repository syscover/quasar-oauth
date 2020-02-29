<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OAuthCreateTableRestHook extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('oauth_rest_hook'))
        {
            Schema::create('oauth_rest_hook', function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->uuid('client_uuid')->nullable();
                $table->string('url');
                $table->string('event');
                $table->boolean('is_active')->default(true);

                $table->timestamps();
                $table->softDeletes();

                $table->index('uuid', 'oauth_rest_hook_uuid_idx');
                $table->index('event', 'oauth_rest_hook_event_idx');
                $table->foreign('client_uuid', 'oauth_rest_hook_client_uuid_fk')
                    ->references('uuid')
                    ->on('oauth_client')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oauth_rest_hook');
    }
}
