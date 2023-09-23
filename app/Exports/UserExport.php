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

      
        $user_details = User::with('userProfile')->whereNot('id','1')->OrderBy('id', 'DESC')->get();


        $UserReport = [];
        $temp = [];
        $temp[] = 'S.no';
        $temp[] = 'Employee name';
        $temp[] = 'Email address';
        $temp[] = 'Mobile number';
        $temp[] = 'Agency name';
        $temp[] = 'Emp id';
        $temp[] = 'Location';

        array_push($UserReport, $temp);
        $s = 1;
        foreach ($user_details as $detail) {
            $full_name = $detail->userProfile->first_name .''.$detail->userProfile->last_name;
            $temp = [];
            $temp['s.no'] = $s++;
            $temp['Employee aame'] = $full_name ?? '' ;
            $temp['Email address'] =  $detail->email ?? '';
            $temp['Mobile number'] =  $detail->phone_number ?? '';
            $temp['Agency name'] =  $detail->userProfile->agency_name ?? '';
            $temp['Emp id'] =  $detail->userProfile->emp_id ?? '';
            $temp['Location'] =  $detail->userProfile->city ?? '';
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
