<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBooksTableAuthorToAuthorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Remove the author column
            $table->dropColumn('author');

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->on('authors')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('author');

            $table->dropForeign('author_id');
            $table->dropColumn('author_id');
        });
    }
}
