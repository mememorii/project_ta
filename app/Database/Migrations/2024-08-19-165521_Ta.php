<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_users' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_referensi' => [
                'type' => 'CHAR',
                'constraint' => '18',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'nik' => [
                'type' => 'BIGINT',
                'constraint' => '16',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'role' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'reset_token' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'reset_expire' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_users', true);
        $this->forge->createTable('tbl_users');

        $this->forge->addField([
            'id_pertanyaan' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'id_referensi' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'pertanyaan_1' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'pertanyaan_2' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'pertanyaan_3' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'pertanyaan_4' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
                'default' => 'NULL',
            ],
            'pertanyaan_5' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
                'default' => 'NULL',
            ],
            'jawaban_1' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'jawaban_2' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'jawaban_3' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'jawaban_4' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
                'default' => 'NULL',
            ],
            'jawaban_5' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
                'default' => 'NULL',
            ],
        ]);
        $this->forge->addKey('id_pertanyaan', true);
        $this->forge->addForeignKey('id_referensi', 'tbl_users', 'id_users', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_forgot');

        $this->forge->addField([
            'nip' => [
                'type' => 'BIGINT',
                'constraint' => 18,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'nik' => [
                'type' => 'BIGINT',
                'constraint' => '16',
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '17',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => '6',
            ],
            'pangkat' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'guru_kelas' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'rombel' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'id_users' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('nip', true);
        $this->forge->addForeignKey('id_users', 'tbl_users', 'id_users', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_guru');

        $this->forge->addField([
            'nisn' => [
                'type' => 'CHAR',
                'constraint' => 10,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'nipd' => [
                'type' => 'INT',
                'constraint' => '4',
            ],
            'nik' => [
                'type' => 'BIGINT',
                'constraint' => '16',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
            ],
            'tanggal_lahir' => [
                'type' => 'DATE',
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
            ],
            'rt' => [
                'type' => 'INT',
                'constraint' => '2',
            ],
            'rw' => [
                'type' => 'INT',
                'constraint' => '2',
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => '19',
            ],
            'kelas' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'rombel' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '11',
            ],
            'id_users' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('nisn', true);
        $this->forge->addForeignKey('id_users', 'tbl_users', 'id_users', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_siswa');

        $this->forge->addField([
            'nik' => [
                'type' => 'BIGINT',
                'constraint' => '16',
            ],
            'nisn_siswa' => [
                'type' => 'CHAR',
                'constraint' => '10',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '60',
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => '9',
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => '13',
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => '13',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '70',
            ],
            'kelas_siswa' => [
                'type' => 'INT',
                'constraint' => '1',
            ],
            'rombel_siswa' => [
                'type' => 'VARCHAR',
                'constraint' => '1',
            ],
            'id_users' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('nik', true);
        $this->forge->addForeignKey('id_users', 'tbl_users', 'id_users', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_wali');

        $this->forge->addField([
            'id_feedback' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true,
            ],
            'id_referensi' => [
                'type' => 'CHAR',
                'constraint' => '18',
            ],
            'tanggal DATETIME DEFAULT CURRENT_TIMESTAMP',
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '8',
                'default' => 'open',
            ],
            'closed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'rating INT(1) DEFAULT NULL',
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'responden BIGINT(18) DEFAULT NULL',
            'resolusi TEXT DEFAULT NULL',
        ]);
        $this->forge->addKey('id_feedback', true);
        $this->forge->addForeignKey('responden', 'tbl_guru', 'nip', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_feedback');

        $this->forge->addField([
            'id_image' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true,
            ],
            'id_feedback' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'filename' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'default' => 'NULL',
            ],
            'filepath' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'default' => 'NULL',
            ],
        ]);
        $this->forge->addKey('id_image', true);
        $this->forge->addForeignKey('id_feedback', 'tbl_feedback', 'id_feedback', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_image');

        $this->forge->addField([
            'id_komentar' => [
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true,
            ],
            'id_feedback' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'notes' => [
                'type' => 'TEXT',
            ],
            'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'user_comment' => [
                'type' => 'CHAR',
                'constraint' => '18',
            ],
            'read' => [
                'type' => 'INT',
                'constraint' => '11',
                'default' => '0',
            ],
        ]);
        $this->forge->addKey('id_komentar', true);
        $this->forge->addForeignKey('id_feedback', 'tbl_feedback', 'id_feedback', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_komentar');
    }

    public function down()
    {
       
    }
}
