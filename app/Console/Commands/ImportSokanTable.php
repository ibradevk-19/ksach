<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportSokanTable extends Command
{
    // اسم الأمر
    protected $signature = 'database:import-sokan';

    // وصف الأمر
    protected $description = 'Import the sokan table from a SQL file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // مسار ملف SQL
        $path = database_path('acto.sql');

        // التحقق من وجود الملف
        if (!File::exists($path)) {
            $this->error('SQL file not found!');
            return 1;
        }

        // قراءة الملف وتنفيذ الاستعلامات
        $sql = File::get($path);

        try {
            DB::unprepared($sql);
            $this->info('Sokan table imported successfully!');
        } catch (\Exception $e) {
            $this->error('Error importing sokan table: ' . $e->getMessage());
        }

        return 0;
    }
}
