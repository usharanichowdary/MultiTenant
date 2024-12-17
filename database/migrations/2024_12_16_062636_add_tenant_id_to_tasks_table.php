<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('tenant_id')->after('completed'); 
            $table->foreign('tenant_id')                     
                  ->references('id')->on('tenants')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']); 
            $table->dropColumn('tenant_id');   
        });
    }
};
