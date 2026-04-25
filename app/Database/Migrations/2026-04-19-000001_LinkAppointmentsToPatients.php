<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class LinkAppointmentsToPatients extends Migration
{
    public function up()
    {
        $this->forge->addColumn('appointments', [
            'patient_ref_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
            'appt_type' => [
                'type'       => 'ENUM',
                'constraint' => ['OPD', 'IPD'],
                'default'    => 'OPD',
                'after'      => 'patient_ref_id',
            ],
        ]);
        // FK: if patient deleted, set null
        $this->db->query('ALTER TABLE appointments ADD CONSTRAINT fk_appt_patient FOREIGN KEY (patient_ref_id) REFERENCES patients(id) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE appointments DROP FOREIGN KEY fk_appt_patient');
        $this->forge->dropColumn('appointments', 'patient_ref_id');
        $this->forge->dropColumn('appointments', 'appt_type');
    }
}
