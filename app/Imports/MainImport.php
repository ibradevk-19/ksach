<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Actor;
use App\Models\WordFood;
use App\Models\Civilrecord;
use App\Models\ImportExcelResulte;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log; // Import Log facade

class MainImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // Log the start of the import process
        Log::info('Starting Excel import process.');

        // Clear old import results
        $all = ImportExcelResulte::get();
        foreach ($all as $key => $attribute) {
            $attribute->delete();
        }
        Log::info('Cleared previous import results.');

        // Process the collection from Excel
        foreach ($collection as $key => $attribute) {
            try {
                // Skip the first few rows if necessary
                if ($key < 4) {
                    Log::debug('Skipping row: ' . $key);
                    continue;
                }

                if ($attribute[3] != null) {
                    // Check if the user already exists
                    $user_exest = WordFood::where('id_num', $attribute[3])->first();
                    $user_data = WordFood::where('id_num', $attribute[3])->first();

                    if ($user_exest) {
                        Log::info('Duplicate user found for ID: ' . $attribute[3]);

                        ImportExcelResulte::create([
                            'full_name' => $attribute[2],
                            'id_num' => $attribute[3],
                            'wife_name' => $attribute[4],
                            'wife_id_num' => $attribute[5],
                            'family_count' => $attribute[7],
                            'marital_status' => 1,
                            'mobile' => $attribute[6],
                            'reson' => 'مكرر'
                        ]);
                    } elseif ($user_data == null) {
                        Log::warning('Invalid ID found: ' . $attribute[3]);

                        ImportExcelResulte::create([
                            'full_name' => $attribute[2],
                            'id_num' => $attribute[3],
                            'wife_name' => $attribute[4],
                            'wife_id_num' => $attribute[5],
                            'family_count' => $attribute[7],
                            'marital_status' => 1,
                            'mobile' => $attribute[6],
                            'reson' => 'رقم الهوية خطأ'
                        ]);
                    } else {
                        Log::info('New user being added for ID: ' . $attribute[3]);

                        WordFood::create([
                            'full_name' => $attribute[2],
                            'id_num' => $attribute[3],
                            'wife_name' => $attribute[4],
                            'wife_id_num' => $attribute[5],
                            'family_count' => $attribute[7],
                            'marital_status' => 1,
                            'mobile' => $attribute[6],
                            'family_id' => Family::where('code', $attribute[8])->first()->id ?? null,
                            'actor_id' => Actor::where('id', $attribute[9])->first()->id ?? null,
                            'status' => 2 // لم يستلم
                        ]);
                    }
                }

            } catch (\Throwable $th) {
                // Log the error message and return it
                Log::error('Error processing row ' . $key . ': ' . $th->getMessage());
                return $th;
            }
        }

        // Log the completion of the import process
        Log::info('Excel import process completed.');
    }
}
