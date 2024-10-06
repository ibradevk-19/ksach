<?php

namespace App\Jobs;

use App\Imports\DataImportWithProgress;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $component;
    protected $totalRows;
    protected $actor_id;

    public function __construct($filePath, $component, $totalRows,$actor_id)
    {
        $this->filePath = $filePath;
        $this->component = $component;
        $this->totalRows = $totalRows;
        $this->actor_id = $actor_id;
    }

    public function handle()
    {
        // استيراد البيانات مع تحديث نسبة التقدم
        Excel::import(new DataImportWithProgress($this->component, $this->totalRows,$this->actor_id), storage_path('app/' . $this->filePath));
        // استخدام `storage_path` للحصول على المسار الصحيح للملف
    }
}
