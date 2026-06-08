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
        $fileName = 'rekomendasi_' . date('Y-m-d') . '.xls';
        $logs = RecLog::latest()->get();

        $escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');

        $html = '<table border="1">';
        $html .= '<thead><tr>';
        $html .= '<th>ID</th><th>Jenis Kain</th><th>Warna</th><th>Motif</th><th>Tingkat Kekotoran</th><th>Metode Rekomendasi</th><th>Skor SAW</th><th>Tanggal</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($logs as $log) {
            $score = is_array($log->saw_scores) ? json_encode($log->saw_scores) : (string) $log->saw_scores;
            $createdAt = $log->created_at ? $log->created_at->format('Y-m-d H:i:s') : '';

            $html .= '<tr>';
            $html .= '<td>' . $escape($log->id) . '</td>';
            $html .= '<td>' . $escape($log->fabric) . '</td>';
            $html .= '<td>' . $escape($log->color) . '</td>';
            $html .= '<td>' . $escape($log->motif) . '</td>';
            $html .= '<td>' . $escape($log->dirt_level) . '</td>';
            $html .= '<td>' . $escape($this->getMethodName($log->top_method)) . '</td>';
            $html .= '<td>' . $escape($score) . '</td>';
            $html .= '<td>' . $escape($createdAt) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
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
