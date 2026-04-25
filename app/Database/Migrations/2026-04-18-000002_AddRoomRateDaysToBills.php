<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoomRateDaysToBills extends Migration
{
    public function up()
    {
        $this->forge->addColumn('bills', [
            'room_rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'discharge_date',
            ],
            'room_days' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 0,
                'after'      => 'room_rate',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bills', 'room_rate');
        $this->forge->dropColumn('bills', 'room_days');
    }
}
