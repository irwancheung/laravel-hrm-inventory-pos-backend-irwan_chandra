<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->boolean('is_superadmin')->default(false);
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->string('user_type')->default('employee');
            $table->boolean('login_enabled')->default(true);
            $table->string('profile_image')->nullable();
            $table->string('status')->default('enable');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('cascade');
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
