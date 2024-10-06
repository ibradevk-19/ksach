<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\ImportExcelJob;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Models\Actor;

class ImportExcel extends Component
{
    use WithFileUploads;

    public $file;
    public $progress = 0;
    public $actor_id;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
    }

    public function import()
    {
        // التحقق من صحة الملف
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // حساب عدد الصفوف في ملف Excel
        $totalRows = Excel::toArray(new HeadingRowImport, $this->file->getRealPath())[0];
        $totalRowsCount = count($totalRows);

        // تخزين الملف مؤقتًا
        $filePath = $this->file->store('imports'); // يتم الآن تخزين الملف مؤقتاً

        // **إعادة تعيين الملف بعد تخزينه**
        $this->reset('file'); // هذا يزيل `TemporaryUploadedFile` من المكون Livewire

        // إرسال Job لاستيراد البيانات مع تمرير مسار الملف وعدد الصفوف
        ImportExcelJob::dispatch($filePath, $this, $totalRowsCount,$this->actor_id);

        session()->flash('message', 'Import job dispatched! Check back later for progress.');

        // إعادة تعيين النسبة بعد إرسال الطلب
        $this->reset('progress');
    }

    public function updateProgress($progress)
    {
        $this->progress = $progress;
    }

    public function render()
    {
        $actors = Actor::all();

        return view('livewire.import-excel')->with([
            'actors' => $actors
        ]);
    }
}
