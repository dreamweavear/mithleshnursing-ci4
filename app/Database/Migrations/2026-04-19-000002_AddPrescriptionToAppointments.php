<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPrescriptionToAppointments extends Migration
{
    public function up()
    {
        $fields = [
            'chief_complaint' => ['type' => 'TEXT', 'null' => true, 'after' => 'reason'],
            'diagnosis'       => ['type' => 'TEXT', 'null' => true, 'after' => 'chief_complaint'],
            'prescription'    => ['type' => 'TEXT', 'null' => true, 'after' => 'diagnosis'],
            'advice'          => ['type' => 'TEXT', 'null' => true, 'after' => 'prescription'],
            'followup_date'   => ['type' => 'DATE', 'null' => true, 'after' => 'advice'],
        ];
        $this->forge->addColumn('appointments', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('appointments', ['chief_complaint', 'diagnosis', 'prescription', 'advice', 'followup_date']);
    }
}
