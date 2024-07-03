<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \App\Validation\AuthRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $valid_nik = [
        'nama' => 'required|min_length[3]|max_length[60]',
        'nik' => 'required|min_length[16]|max_length[16]',
    ];

    public $nik_error = [
        'nama' => [
            'required' => 'Nama tidak boleh kosong.',
            'min_length' => 'Nama harus memiliki setidaknya {param} karakter.',
            'max_length' => 'Nama tidak boleh lebih dari {param} karakter.'
        ],
        'nik' => [
            'required' => 'NIK tidak boleh kosong.',
            'min_length' => 'NIK harus memiliki setidaknya {param} karakter.',
            'max_length' => 'NIK tidak boleh lebih dari {param} karakter.',
            'is_unique' => 'NIK sudah terdaftar.'
        ],
    ];

}
