<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricsTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create( 'metrics' , function (Blueprint $table) {
            $table->increments( 'id' );
            $table->timestamps();
            $table->integer( 'user_id' )->unsigned();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )
                    ->onUpdate( 'restrict' )
                    ->onDelete( 'cascade' );
            $table->string( 'name' );
            $table->string( 'symbol' );
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists( 'metrics' );
    }

}
