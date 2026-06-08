<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecLog;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        $stats = [
            'today' => RecLog::whereDate('created_at', $today)->count(),
            'week' => RecLog::where('created_at', '>=', $thisWeek)->count(),
            'month' => RecLog::where('created_at', '>=', $thisMonth)->count(),
            'popular_method' => $this->getMethodName(RecLog::select('top_method', DB::raw('count(*) as total'))
                ->groupBy('top_method')
                ->orderByDesc('total')
                ->first()?->top_method ?? '-'),
            'popular_article' => Article::orderByDesc('views')->first()?->title ?? '-',
        ];

        // Chart data (last 7 days)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartData['labels'][] = $date->format('d M');
            $chartData['values'][] = RecLog::whereDate('created_at', $date)->count();
        }

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    public function export()
    {
        $fileName = 'rekomendasi_' . date('Y-m-d') . '.xlsx';

        $export = new class($this) implements FromCollection, WithHeadings, WithMapping
        {
            public function __construct(private DashboardController $controller) {}

            public function collection()
            {
                return RecLog::latest()->get();
            }

            public function headings(): array
            {
                return ['ID', 'Jenis Kain', 'Warna', 'Motif', 'Tingkat Kekotoran', 'Metode Rekomendasi', 'Skor SAW', 'Tanggal'];
            }

            public function map($log): array
            {
                $score = is_array($log->saw_scores) ? json_encode($log->saw_scores) : (string) $log->saw_scores;

                return [
                    $log->id,
                    $log->fabric,
                    $log->color,
                    $log->motif,
                    $log->dirt_level,
                    $this->controller->getMethodName($log->top_method),
                    $score,
                    optional($log->created_at)->format('Y-m-d H:i:s'),
                ];
            }
        };

        return Excel::download($export, $fileName);
    }

    private function getMethodName($m)
    {
        $names = [
            'M1' => 'Cuci tangan air dingin',
            'M2' => 'Cuci tangan air hangat',
            'M3' => 'Mesin cuci normal',
            'M4' => 'Mesin cuci halus',
            'M5' => 'Dry cleaning',
        ];
        return $names[$m] ?? $m;
    }
}
