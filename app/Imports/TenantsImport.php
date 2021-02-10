<?php

namespace App\Imports;

use App\Models\Tel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class TenantsImport implements ToModel,WithStartRow,WithValidation,SkipsOnFailure,WithChunkReading, ShouldQueue,WithBatchInserts
{
    use Importable,SkipsFailures;

    public function model(array $row)
    {
        return new Tel([
            'tel' => $row[0],
            'up_time' => $row[1],
            // 'status' => $row[2]
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [
            '0' => 'required',
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    // public function customValidationMessages()
    // {
    //      '0.required' => '电话未填',
    //      '1.required' => '日期未填',
    // }
}
