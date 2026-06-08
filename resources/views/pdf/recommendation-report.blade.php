<div class="tc-pdf">
    <style>
        .tc-pdf,
        .tc-pdf * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tc-page {
            width: 210mm;
            min-height: 297mm;
            background: #ffffff;
            color: #1a202c;
            padding: 18mm 16mm;
            position: relative;
            overflow: hidden;
            border: 10px solid #0a192f;
        }

        .tc-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            font-size: 72px;
            color: rgba(10, 25, 47, 0.04);
            white-space: nowrap;
            font-weight: 800;
            z-index: 0;
            pointer-events: none;
        }

        .tc-content {
            position: relative;
            z-index: 1;
        }

        .tc-header {
            width: 100%;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 16px;
            margin-bottom: 22px;
        }

        .tc-logo {
            font-size: 24px;
            font-weight: 800;
            color: #0a192f;
            letter-spacing: -0.5px;
        }

        .tc-logo span {
            color: #3498db;
        }

        .tc-meta {
            text-align: right;
            font-size: 12px;
            color: #718096;
            line-height: 1.4;
        }

        .tc-title {
            background: #0a192f;
            color: #ffffff;
            padding: 22px 18px;
            text-align: center;
            margin-bottom: 22px;
        }

        .tc-title .kicker {
            font-size: 12px;
            opacity: 0.85;
            letter-spacing: 1px;
        }

        .tc-title h1 {
            margin: 10px 0 0;
            font-size: 22px;
            letter-spacing: 2px;
        }

        .tc-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 12px 0;
            margin-bottom: 18px;
        }

        .tc-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 14px;
            vertical-align: top;
        }

        .tc-card-title {
            font-weight: 700;
            font-size: 12px;
            color: #2d3748;
            margin: 0 0 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            letter-spacing: 0.6px;
        }

        .tc-row {
            font-size: 12px;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .tc-label {
            color: #718096;
            display: inline-block;
            width: 110px;
        }

        .tc-value {
            font-weight: 700;
            color: #1a202c;
        }

        .tc-reco {
            background: #f0f9ff;
            border: 2px solid #3498db;
            padding: 16px;
            margin: 18px 0 18px;
            text-align: center;
        }

        .tc-reco .label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #3498db;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .tc-reco h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 900;
            color: #0a192f;
        }

        .tc-score {
            display: inline-block;
            margin-top: 12px;
            background: #3498db;
            color: #ffffff;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 800;
        }

        .tc-section-title {
            margin: 18px 0 10px;
            font-size: 14px;
            font-weight: 900;
            color: #0a192f;
            letter-spacing: 1px;
        }

        .tc-step {
            padding: 12px 12px 12px 14px;
            border-left: 4px solid #0a192f;
            background: #ffffff;
            margin-bottom: 10px;
            border: 1px solid #edf2f7;
        }

        .tc-step-no {
            font-weight: 900;
            color: #0a192f;
            margin-bottom: 4px;
            font-size: 13px;
        }

        .tc-step-title {
            font-weight: 800;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .tc-step-desc {
            font-size: 12px;
            color: #4a5568;
            line-height: 1.4;
        }

        .tc-tip {
            margin-top: 8px;
            background: #fffbeb;
            border: 1px dashed #f6ad55;
            padding: 8px 10px;
            font-size: 11px;
            color: #975a16;
        }

        .tc-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        .tc-table th {
            background: #f8fafc;
            text-align: left;
            padding: 10px;
            font-size: 11px;
            color: #718096;
            border-bottom: 2px solid #e2e8f0;
        }

        .tc-table td {
            padding: 10px;
            border-bottom: 1px solid #edf2f7;
            font-size: 12px;
            vertical-align: top;
        }

        .tc-pill {
            display: inline-block;
            background: #ebf8ff;
            color: #3182ce;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 800;
        }

        .tc-footer {
            margin-top: 20px;
            border-top: 1px solid #edf2f7;
            padding-top: 12px;
            text-align: center;
            font-size: 11px;
            color: #a0aec0;
            line-height: 1.4;
        }
    </style>

    <div class="tc-page">
        <div class="tc-watermark">TEMANCUCI</div>
        <div class="tc-content">
            <table class="tc-header">
                <tr>
                    <td>
                        <div class="tc-logo">Teman<span>Cuci</span></div>
                    </td>
                    <td class="tc-meta">
                        <div>ID LAPORAN: <strong>TC-{{ date('Ymd') }}-{{ strtoupper(\Illuminate\Support\Str::random(4)) }}</strong></div>
                        <div>TANGGAL: <strong>{{ date('d/m/Y') }}</strong></div>
                    </td>
                </tr>
            </table>

            <div class="tc-title">
                <div class="kicker">LAPORAN ANALISIS SISTEM PAKAR</div>
                <h1>REKOMENDASI PENCUCIAN</h1>
            </div>

            <table class="tc-grid">
                <tr>
                    <td class="tc-card" style="width: 50%;">
                        <div class="tc-card-title">Profil Pakaian</div>
                        <div class="tc-row"><span class="tc-label">Jenis Kain</span> <span class="tc-value">: {{ $input['fabric_type'] }}</span></div>
                        <div class="tc-row"><span class="tc-label">Warna Utama</span> <span class="tc-value">: {{ $input['color'] }}</span></div>
                        <div class="tc-row"><span class="tc-label">Motif/Ornamen</span> <span class="tc-value">: {{ $input['pattern'] }}</span></div>
                        <div class="tc-row"><span class="tc-label">Tingkat Kotor</span> <span class="tc-value">: {{ $input['dirt_level'] }}</span></div>
                    </td>
                    <td class="tc-card" style="width: 50%;">
                        <div class="tc-card-title">Metode Analisis</div>
                        <div class="tc-row"><span class="tc-label">Algoritma 1</span> <span class="tc-value">: Rule-Based Filtering</span></div>
                        <div class="tc-row"><span class="tc-label">Algoritma 2</span> <span class="tc-value">: SAW (Weighting)</span></div>
                        <div class="tc-row"><span class="tc-label">Status</span> <span class="tc-value">: <span style="color: #38a169;">VALIDATED</span></span></div>
                        <div class="tc-row"><span class="tc-label">Waktu Proses</span> <span class="tc-value">: < 0.5 detik</span></div>
                    </td>
                </tr>
            </table>

            <div class="tc-reco">
                <span class="label">HASIL ANALISIS TERBAIK</span>
                <h2>{{ $best['method_name'] }}</h2>
                <div class="tc-score">SKOR KELAYAKAN: {{ number_format($best['score'] * 100, 1) }}%</div>
            </div>

            <div class="tc-section-title">PANDUAN OPERASIONAL</div>
            @foreach($best['steps'] as $step)
                <div class="tc-step">
                    <div class="tc-step-no">Langkah {{ $step->step_order }}</div>
                    <div class="tc-step-title">{{ $step->title }}</div>
                    <div class="tc-step-desc">{{ $step->description }}</div>
                    @if($step->tip)
                        <div class="tc-tip"><strong>TIPS:</strong> {{ $step->tip }}</div>
                    @endif
                </div>
            @endforeach

            <div class="tc-section-title">REKOMENDASI BAHAN PEMBERSIH</div>
            <table class="tc-table">
                <thead>
                    <tr>
                        <th>NAMA DETERJEN</th>
                        <th>JENIS</th>
                        <th>CATATAN PENGGUNAAN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($best['detergents'] as $det)
                        <tr>
                            <td style="font-weight: 900;">{{ $det->detergent_name }}</td>
                            <td><span class="tc-pill">{{ $det->detergent_type }}</span></td>
                            <td style="color: #4a5568;">{{ $det->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #a0aec0;">Gunakan deterjen standar dengan pH netral.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="tc-footer">
                Laporan ini dihasilkan oleh Sistem Pendukung Keputusan TemanCuci.<br>
                <strong>&copy; {{ date('Y') }} TemanCuci - Smart Laundry Assistant</strong>
            </div>
        </div>
    </div>
</div>
