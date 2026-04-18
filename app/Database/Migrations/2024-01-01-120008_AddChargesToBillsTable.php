<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddChargesToBillsTable extends Migration
{
    public function up()
    {
        $fields = [
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
                'after'      => 'assistance_charges',
            ],
            'room_charge_per_day' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
                'after'      => 'discount_percent',
            ],
            'no_of_days' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'after'      => 'room_charge_per_day',
            ],
        ];

        $this->forge->addColumn('bills', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('bills', [
            'surgery_charges',
            'anaesthesia_charges',
            'ot_charges',
            'nursing_charges',
            'assistance_charges',
            'discount_percent',
            'room_charge_per_day',
            'no_of_days',
        ]);
    }
}
