<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    use Exportable;
    public $val;

    public function __construct($request)
    {
        $this->val = $request;
    }
    public function collection()
    {

      
            $user_details = User::with('userProfile')->OrderBy('id', 'DESC')->get();
            dd($user_details);
      


        $UserReport = [];
        $temp = [];
        $temp[] = 'S.No';
        $temp[] = 'Type';
       
        $temp[] = 'Applied Date';
        $temp[] = 'Comp-off Date';
        $temp[] = 'Extra hour worked';
        $temp[] = 'Summary of the tasks completed';
        $temp[] = 'Status';
        $temp[] = 'Status Reason';

        array_push($UserReport, $temp);
        $s = 1;
        foreach ($user_details as $detail) {
            $temp = [];
            $temp['s.no'] = $s++;
            $temp['type'] = 'Comp Off';
          
            $temp['created_at'] =  date(setting('date_format'), strtotime($detail->created_at));
            $temp['date_of_extra_work'] =  date(setting('date_format'), strtotime($detail->date_of_extra_work));
            $temp['comp_off_days'] = $detail->comp_off_days != '' ? ucwords($detail->comp_off_days) : '- NA -';
            $temp['reason_for_extra_hours'] = $detail->reason_for_extra_hours;
            $temp['comp_off_status'] = $detail->status == 1 ? 'Pending' : ($detail->status == 2 ? 'Approved' : 'Rejected');
            $temp['status_reason'] = $detail->status_reason != '' ? ucwords($detail->status_reason) : '- NA -';

            array_push($UserReport, $temp);
        }
        return collect($UserReport);
    }

    public function headings(): array
    {
        return [];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);

                Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
                    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
                });

                $event->sheet->getStyle('A1:K1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('d8c69aa6');

                $event->sheet->styleCells(
                    'A1:K1',
                    [
                        'font' => array(
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'color' => ['argb' => 'FFFFFF'],
                        )
                    ]
                );
            },
        ];
    }
}
