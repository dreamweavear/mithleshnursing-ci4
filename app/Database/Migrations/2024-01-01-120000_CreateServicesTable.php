<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'unique' => true,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
            ],
            'display_order' => [
                'type' => 'INT',
                'constraint' => 5,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('services');
        
        // Insert sample services
        $services = [
            [
                'title' => 'General Medicine',
                'slug' => 'general-medicine',
                'description' => 'Comprehensive general medical care for all age groups including diagnosis, treatment, and preventive healthcare services.',
                'icon' => 'bi bi-heart-pulse',
                'display_order' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Emergency Services',
                'slug' => 'emergency-services',
                'description' => '24/7 emergency medical services with fully equipped ICU and trauma care facilities.',
                'icon' => 'bi bi-life-preserver',
                'display_order' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Laboratory Services',
                'slug' => 'laboratory-services',
                'description' => 'State-of-the-art diagnostic laboratory offering comprehensive pathology and radiology services.',
                'icon' => 'bi bi-clipboard2-pulse',
                'display_order' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Pharmacy',
                'slug' => 'pharmacy',
                'description' => '24-hour pharmacy service with a wide range of medicines and medical supplies.',
                'icon' => 'bi bi-capsule',
                'display_order' => 4,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Surgery',
                'slug' => 'surgery',
                'description' => 'Modern operation theaters equipped with advanced surgical equipment for various procedures.',
                'icon' => 'bi bi-scissors',
                'display_order' => 5,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Maternity Care',
                'slug' => 'maternity-care',
                'description' => 'Complete maternity services including prenatal care, delivery, and postnatal support.',
                'icon' => 'bi bi-balloon-heart',
                'display_order' => 6,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $this->db->table('services')->insertBatch($services);
    }

    public function down()
    {
        $this->forge->dropTable('services');
    }
}
