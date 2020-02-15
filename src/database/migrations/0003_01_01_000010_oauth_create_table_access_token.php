<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminCreateTableLang extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('oauth_access_token'))
		{
			Schema::create('oauth_access_token', function (Blueprint $table) {
				$table->engine = 'InnoDB';

                $table->increments('id');
                $table->uuid('uuid');
                $table->text('token');
                $table->string('name')->nullable();
                $table->boolean('is_revoked');
                $table->uuid('user_uuid');
                $table->string('user_type');
                $table->dateTime('expires_at')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('oauth_access_token');
	}
}
