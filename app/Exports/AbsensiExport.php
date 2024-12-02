<?php

namespace App\Exports;

use App\Models\Backend\Kelas;
use App\Models\Backend\siswa;
use App\Models\Backend\absensi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AbsensiExport implements FromCollection, WithHeadings, WithEvents, WithTitle, WithStyles, ShouldAutoSize
{
    protected $class_id;
    protected $month;
    protected $year;

    public function __construct($class_id, $month, $year)
    {
        $this->class_id = $class_id;
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        $siswa = siswa::where('class_id', $this->class_id)->get();

        $data = [];
        $no = 1;

        foreach ($siswa as $s) {
            $absensi = absensi::where('student_id', $s->id)
                ->whereMonth('date', $this->month)
                ->whereYear('date', $this->year)
                ->get(['date', 'status', 'student_id']);

            $hadir = $absensi->where('status', 'hadir')->count();
            $izin = $absensi->where('status', 'izin')->count();
            $sakit = $absensi->where('status', 'sakit')->count();
            $alpha = $absensi->where('status', 'alpha')->count();

            $hadir = $hadir > 0 ? $hadir : 0;
            $izin = $izin > 0 ? $izin : 0;
            $sakit = $sakit > 0 ? $sakit : 0;
            $alpha = $alpha > 0 ? $alpha : 0;

            $totalHari = $absensi->count();
            $rataHadir = $totalHari > 0 ? round(($hadir / $totalHari) * 100, 2) : 0;

            $data[] = [
                'no' => $no++,
                'name' => $s->name,
                'nisn' => $s->nisn,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpha' => $alpha,
                'rata_hadir' => $rataHadir . '%',
            ];
        }

        $sortedData = collect($data)->sortBy('name');

        $sortedData = $sortedData->values()->map(function ($item, $key) {
            $item['no'] = $key + 1;
            return $item;
        });


        return $sortedData;
    }

    public function headings(): array
    {
        $kelas = DB::table('kelas')->where('id', $this->class_id)->first();
        // dd($kelas); 
        $kelasName = $kelas ? $kelas->name_kelas : 'Kelas Tidak Ditemukan';
        return [

            ['Laporan Absensi Siswa - ' . $kelasName],
            ['Periode: ' . date('F Y', strtotime($this->year . '-' . $this->month . '-01'))],
            ['NO', 'Nama Siswa', 'NISN', 'Hadir', 'Izin', 'Sakit', 'Alpha', 'Rata-rata Kehadiran',]
        ];
    }

    public function styles($sheet)
    {
        $kelas = DB::table('kelas')->where('id', $this->class_id)->first();
        $kelasName = $kelas ? $kelas->name_kelas : 'Kelas Tidak Ditemukan';

        // Menggabungkan sel untuk judul dan periode
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');

        $sheet->getCell('A1')->setValue('Laporan Absensi Siswa - ' . $kelasName);
        $sheet->getCell('A2')->setValue('Periode: ' . date('F Y', strtotime($this->year . '-' . $this->month . '-01')));

        // Mengatur font dan posisi judul
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Mengatur font dan posisi periode
        $sheet->getStyle('A2')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // Membuat Heading Bold dan Tengah
        $sheet->getStyle('A3:H3')->getFont()->setBold(true);
        $sheet->getStyle('A3:H3')->getAlignment()->setHorizontal('center');

        $row = 4;
        $spreadsheet = $sheet->getParent();


        foreach ($this->collection() as $siswa) {

            $studentDetailSheet = $spreadsheet->createSheet();
            $studentDetailSheet->setTitle(substr($siswa['name'], 0, 31));
            // Menambahkan header detail untuk Nama Siswa dan NISN
            $studentDetailSheet->mergeCells('A1:C1');
            $studentDetailSheet->mergeCells('A2:C2');
            $studentDetailSheet->setCellValue('A1', 'Nama Siswa: ' . $siswa['name']);
            $studentDetailSheet->setCellValue('A2', 'NISN: ' . $siswa['nisn']);

            // Membuat tulisan Nama Siswa dan NISN menjadi bold dan di tengah
            $studentDetailSheet->getStyle('A1')->getFont()->setBold(true);
            $studentDetailSheet->getStyle('A2')->getFont()->setBold(true);
            $studentDetailSheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $studentDetailSheet->getStyle('A2')->getAlignment()->setHorizontal('center');

            // Menambahkan header tabel
            $studentDetailSheet->setCellValue('A4', 'No');
            $studentDetailSheet->setCellValue('B4', 'Tanggal');
            $studentDetailSheet->setCellValue('C4', 'Status Absensi');

            $studentDetailSheet->getStyle('A4:C4')->getAlignment()->setHorizontal('center');

            // Styling header untuk sheet detail
            $headerStyle = [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => '000000'], 
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFF00'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ];

            // Terapkan style pada header
            $studentDetailSheet->getStyle('A4:C4')->applyFromArray($headerStyle);

            $absensiData = absensi::whereHas('siswa', function ($query) use ($siswa) {
                $query->where('nisn', $siswa['nisn']);
            })
                ->whereYear('date', $this->year)
                ->whereMonth('date', $this->month)
                ->orderBy('date', 'asc') // Mengurutkan berdasarkan tanggal terkecil
                ->get(['date', 'status', 'student_id']);

            $rowDetail = 5;
            $rowNumber = 1;
            foreach ($absensiData as $absensi) {
                $studentDetailSheet->setCellValue('A' . $rowDetail, $rowNumber++);
                $studentDetailSheet->setCellValue('B' . $rowDetail, $absensi->date);
                $studentDetailSheet->setCellValue('C' . $rowDetail, $absensi->status);
                $rowDetail++;
            }

            // Menambahkan border pada tabel data detail siswa
            foreach (range(5, $rowDetail - 1) as $row) {
                $status = $studentDetailSheet->getCell('C' . $row)->getValue();
                if ($status == 'alpha') {
                    $studentDetailSheet->getStyle('C' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0CB'); // Merah muda
                } elseif ($status == 'izin') {
                    $studentDetailSheet->getStyle('C' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('ADD8E6'); // Biru muda
                } elseif ($status == 'sakit') {
                    $studentDetailSheet->getStyle('C' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFACD'); // Kuning pastel
                }
            }
            $studentDetailSheet->getStyle('A4:C' . ($rowDetail - 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $studentDetailSheet->getStyle('A5:C' . ($rowDetail - 1))->getAlignment()->setHorizontal('center');

            // Mengatur ukuran kolom otomatis di sheet detail
            $studentDetailSheet->getColumnDimension('A')->setAutoSize(true);
            $studentDetailSheet->getColumnDimension('B')->setAutoSize(true);
            $studentDetailSheet->getColumnDimension('C')->setAutoSize(true);
        }

        // Memberikan border pada tabel data sheet utama
        $sheet->getStyle('A4:H' . (count($this->collection()) + 4))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Warna border hitam
                ],
            ],
        ]);

        // Mengatur alignment data di tengah
        $sheet->getStyle('A4:H' . (count($this->collection()) + 4))->getAlignment()->setHorizontal('center');

        return [
            'A3:H3' => [
                'font' => ['bold' => true, 'color' => ['argb' => '000000']], 
                'alignment' => ['horizontal' => 'center'],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFF99'], 
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]
        ];
    }


    public function title(): string
    {
        return 'Rekap Absensi per Kelas';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Styling header untuk sheet utama
                $headerStyle = [
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['argb' => '000000'], 
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'ADD8E6'], 
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'], 
                        ],
                    ],
                ];

                // Terapkan style pada header
                $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

                // Set ukuran kolom otomatis
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);

                // Set format for NISN column to number
                $sheet->getStyle('C4:C' . (count($this->collection()) + 4))
                    ->getNumberFormat()
                    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);
            }

        ];
    }
}
