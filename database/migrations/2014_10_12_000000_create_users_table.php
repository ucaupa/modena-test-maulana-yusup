<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nik', 16)->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->string('bank_name');
            $table->string('bank_account');
            $table->boolean('has_npwp')->default(false);
            $table->string('npwp')->unique()->nullable();

            $table->integer('postal_code')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('province_id')->nullable();
            $table->text('address')->nullable();

            $table->unsignedBigInteger('organization_id');
            $table->string('role_id');
            $table->string('password');

            $table->boolean('is_active')->default(true);
            $table->boolean('is_access_mobile')->default(false);
            $table->boolean('cti_usage')->default(false);
            $table->boolean('tmm')->default(false);
            $table->integer('limit_days')->nullable();
            $table->integer('limit_amount')->nullable();
            $table->string('warehouse_request')->nullable();
            $table->string('erp_user_id')->nullable();

            $table->string('photo_profile_path')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
