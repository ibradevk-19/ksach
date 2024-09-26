<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BeneficialCheckerImportCo;

class ExcelCheck extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $progress = 0;
    public $checkedNumbers = [];
    public $totalRows = 0;

    public function updatedExcelFile()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xls,xlsx',
        ]);
    }

    public function checkNumbers()
    {
        $this->validate([
            'excelFile' => 'required|mimes:xls,xlsx',
        ]);

        // تحميل الملف واستخدام الـ Import لفحص الأرقام
        Excel::import(new BeneficialCheckerImportCo($this), $this->excelFile);

        $this->progress = 100; // إكمال شريط التقدم بعد انتهاء الفحص
    }

    public function updateProgress($progress)
    {
        $this->progress = $progress;
    }

    public function render()
    {
        return view('livewire.excel-check');
    }
}
