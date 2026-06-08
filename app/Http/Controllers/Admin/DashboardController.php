<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecLog;
use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $fileName = 'rekomendasi_' . date('Y-m-d') . '.csv';
        $logs = RecLog::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('ID', 'Jenis Kain', 'Warna', 'Motif', 'Tingkat Kekotoran', 'Metode Rekomendasi', 'Skor SAW', 'Tanggal');

        $callback = function() use($logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logs as $log) {
                $row['ID'] = $log->id;
                $row['Jenis Kain'] = $log->fabric;
                $row['Warna'] = $log->color;
                $row['Motif'] = $log->motif;
                $row['Tingkat Kekotoran'] = $log->dirt_level;
                $row['Metode Rekomendasi'] = $log->top_method;
                $row['Skor SAW'] = is_array($log->saw_scores) ? json_encode($log->saw_scores) : $log->saw_scores;
                $row['Tanggal'] = $log->created_at;

                fputcsv($file, array($row['ID'], $row['Jenis Kain'], $row['Warna'], $row['Motif'], $row['Tingkat Kekotoran'], $row['Metode Rekomendasi'], $row['Skor SAW'], $row['Tanggal']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
