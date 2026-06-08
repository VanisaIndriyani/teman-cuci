<?php

namespace App\Http\Controllers;

use App\Models\RecLog;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function index()
    {
        return view('user.consultation');
    }

    public function process(Request $request)
    {
        $request->validate([
            'fabric_type' => 'required',
            'color' => 'required',
            'pattern' => 'required',
            'dirt_level' => 'required',
        ]);

        $input = $request->all();
        $results = $this->recommendationService->getRecommendation($input);

        // Log the recommendation
        RecLog::create([
            'session_id' => session()->getId(),
            'fabric' => $input['fabric_type'],
            'color' => $input['color'],
            'motif' => $input['pattern'],
            'dirt_level' => $input['dirt_level'],
            'is_batik_modern' => $request->has('is_batik_printing'),
            'is_poly_blend' => $request->has('is_polyester_blend'),
            'top_method' => $results[0]['method_code'],
            'saw_scores' => collect($results)->mapWithKeys(fn($item) => [$item['method_code'] => $item['score']])->toArray(),
            'passed_methods' => collect($results)->pluck('method_code')->toArray(),
            // Extra info for overrides
            'is_denim_new' => $request->has('is_denim_new'),
            'is_sablon_rubber' => $request->has('is_sablon_rubber'),
            'is_bordir_small' => $request->has('is_bordir_small'),
        ]);

        return view('user.recommendation_result', compact('results', 'input'));
    }
}
