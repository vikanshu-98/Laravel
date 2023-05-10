<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class UsersExport implements FromCollection,WithEvents,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function view(): View
    // {
    //    return view('exports.userexport',[
    //     'invoices'=>User::all()
    //    ]);
    // }
    protected  $users;
    protected  $selects;
    protected  $row_count;
    protected  $column_count,$results;
     
    public function collection()
    {    
        $this->results=User::select('name','email')->limit(2)->get();
        return $this->results;
    }
    public function headings(): array
    {
        return [
            'name',
            'email', 
        ];
    }
    

    public function registerEvents():array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {

                // get layout counts (add 1 to rows for heading row)
                $row_count = $this->results->count() + 1;
                //  dd($row_count);
                $column_count = count($this->results[0]->toArray());
                // dd($column_count);
                // set dropdown column
                $drop_column = 'C';

                // set dropdown options
                $options = [
                    'option 1',
                    'option 2',
                    'option 3',
                ]; 
                // set dropdown list for first data row
                //  dd($event->sheet->getDelegate()->styleCells());
                $cellRange = 'A1:C1'; // All headers
                // $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(20);
            //    pp() 
            //    $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getAllBorders();
                $validation = $event->sheet->getDelegate()->getCell("C1")->getDataValidation();
                //  dd($validation);
                // $event->sheet->getDelegate()->setTitle('Vikas');


                //  $styleArray = [
                //     'borders' => [
                //         'allBorders' => [
                //             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN, 
                //             'color' => ['argb' => 'FFFF0000'],
                //         ],
                //     ],
                // ];
                
                 





                $validation->setType(DataValidation::TYPE_LIST );
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list');
                $validation->setPrompt('Please pick a value from the drop-down list.');
                $validation->setFormula1(sprintf('"%s"',implode(',',$options)));
               
// dd($validation);
                // clone validation to remaining rows
                // for ($i = 3; $i <= $row_count; $i++) {
                //     $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                // }

                // $event->sheet->getDelegate()->getStyle('A1:C3')->applyFromArray($styleArray);
                // // set columns to autosize
                for ($i = 1; $i <= $column_count; $i++) {
                    $column = Coordinate::stringFromColumnIndex($i);
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

}
