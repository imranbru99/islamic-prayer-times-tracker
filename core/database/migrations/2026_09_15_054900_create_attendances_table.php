<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                if (!Schema::hasColumn('attendances', 'tahajjud')) {
                    $table->boolean('tahajjud')->default(false);
                }
                if (!Schema::hasColumn('attendances', 'witr')) {
                    $table->boolean('witr')->default(false);
                }
                if (!Schema::hasColumn('attendances', 'notes')) {
                    $table->string('notes', 500)->nullable();
                }
            });
            return;
        }

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->boolean('fajr')->default(false);
            $table->boolean('dhuhr')->default(false);
            $table->boolean('asr')->default(false);
            $table->boolean('maghrib')->default(false);
            $table->boolean('isha')->default(false);
            $table->boolean('tahajjud')->default(false);
            $table->boolean('witr')->default(false);
            $table->string('notes', 500)->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'date']);
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
