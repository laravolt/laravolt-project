<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EpicentrumMigration extends Migration
{
    protected $table;

    protected $columnExists;

    /**
     * AddStatusToUsers constructor.
     */
    public function __construct()
    {
        $this->table = app(config('auth.providers.users.model'))->getTable();
        $this->columnExists = Schema::hasColumn($this->table, 'status');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->table, function (Blueprint $table) {
            if (!$this->columnExists) {
                $table->string('status')->after('email')->index()->nullable();
            }
            $table->string('timezone')->default(config('app.timezone'))->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->dropSoftDeletes();
            if ($this->columnExists) {
                $table->dropColumn('status');
            }
            $table->dropColumn('timezone');
        });
    }
}
