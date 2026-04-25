<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddChargeColumnsToBills extends Migration
{
    public function up()
    {
        // Add surgery_charges after test_charges
        $this->forge->addColumn('bills', [
            'surgery_charges' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'test_charges',
            ],
            'anaesthesia_charges' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'surgery_charges',
            ],
            'ot_charges' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'anaesthesia_charges',
            ],
            'nursing_charges' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'ot_charges',
            ],
            'assistance_charges' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'nursing_charges',
            ],
            'discount_percent' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
                'after'      => 'other_charges',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('bills', 'surgery_charges');
        $this->forge->dropColumn('bills', 'anaesthesia_charges');
        $this->forge->dropColumn('bills', 'ot_charges');
        $this->forge->dropColumn('bills', 'nursing_charges');
        $this->forge->dropColumn('bills', 'assistance_charges');
        $this->forge->dropColumn('bills', 'discount_percent');
    }
}
