<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->foreignIdFor(App\Models\Position::class, 'position_id')->nullable()->default(null);
            $table->date('employment_date');
            $table->string('phone');
            $table->string('email');
            $table->string('photo', 2000);
            $table->string('salary');
            $table->foreignIdFor(App\Models\Employee::class, 'head_id')->nullable();
            $table->foreignIdFor(App\Models\User::class, 'admin_created_id');
            $table->foreignIdFor(App\Models\User::class, 'admin_updated_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emloyees');
    }
}
