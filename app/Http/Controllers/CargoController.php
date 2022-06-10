<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Cargo;


class CargoController extends Controller
{
    public function cargos() {
        $cargos = Cargo::all();

        return Response()->json(['data' => $cargos], 200);
    }

    public function import(Request $request) {

        // validate the file
        $this->validate($request, [
            'file' => 'required|file|mimes:xls,xlsx,csv'
        ]);

        $the_file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'k', $column_limit );
            $startcount = 2;
            $data = array();

            foreach ( $row_range as $row ) {
                $data [] = [
                    'cargo_no' =>$sheet->getCell( 'A' . $row )->getValue(),
                    'cargo_type' => $sheet->getCell( 'B' . $row )->getValue(),
                    'cargo_size' => $sheet->getCell( 'C' . $row )->getValue(),
                    'weight' => $sheet->getCell( 'D' . $row )->getValue(),
                    'remarks' => $sheet->getCell( 'E' . $row )->getValue(),
                    'wharfage' =>$sheet->getCell( 'F' . $row )->getValue(),
                    'penalty' =>$sheet->getCell( 'G' . $row )->getValue(),
                    'storage' =>$sheet->getCell( 'H' . $row )->getCalculatedValue(),
                    'electricity' =>$sheet->getCell( 'I' . $row )->getValue(),
                    'destuffing' =>$sheet->getCell( 'J' . $row )->getValue(),
                    'lifting' =>$sheet->getCell( 'K' . $row )->getValue(),
                    'created_at'=>now()
                ];

                $startcount++;
            }
            DB::table('cargo')->insert($data);
        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            return back()->withErrors('There was a problem uploading the data!');
        }
        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }
}
