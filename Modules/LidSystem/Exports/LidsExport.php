<?php

namespace Modules\LidSystem\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LidsExport implements FromView
{
    protected $lids;

    public function __construct($lids)
    {
        $this->lids = $lids;
    }

    public function view(): View
    {
        return view('lidsystem::exports.lids', [
            'lids' => $this->lids
        ]);
    }
}
