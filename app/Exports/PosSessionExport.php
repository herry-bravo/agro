<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PosSessionExport implements WithMultipleSheets
{
    protected $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function sheets(): array
    {
        return [
            new PosSessionSummarySheet($this->sessionId),
            new PosSessionDetailSheet($this->sessionId),
        ];
    }
}
