<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BibliaExport implements FromView, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function __construct(public $detalles)
    {
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow        = $sheet->getHighestDataRow();
        $lastColumn     = $sheet->getHighestColumn();
        $headerColor    = '375a64';
        $numDataColor   = '99FF33';
        $borderColor    = '000000';

        // Estilo de encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'ffffff']
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => $headerColor
                ]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        // Estilo de datos numéricos
        $numDataStyle = [
            'font' => [
                'color' => ['rgb' => '000000'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => $numDataColor,
                ],
            ],
        ];
        // Estilo de cuadrícula
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => $borderColor],
                ],
            ],
        ];

        // Aplicar estilo a los encabezados
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray($headerStyle);

        foreach ($this->detalles as $index => $detallereserva) {
            $row = $index + 2; // Comenzar en la segunda fila porque la primera es el encabezado
            $color = ltrim($detallereserva->servicio->color ?? 'FFFFFF', '#'); // Asumir blanco si no hay color definido
            
            // Aplicar el color de la fila
            $sheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray([
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => $color,
                    ],
                ],
            ]);
        }
        
    }

    public function view(): View
    {
        $detalles = $this->detalles;
        return view('pages.excel.biblia', compact('detalles'));
    }
}
