<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\jobs;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\apply_job;
class ReportController extends Controller
{
    public function weekly(){
        $now = Carbon::now();
        $DaysAgo = $now->subDays(7);
        $applications = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->count();
        $pending_interviews = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->whereIn('status',[1,2,3])->count();
        $hairs = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->where('status',4)->count();
        $openjobs = jobs::where('is_active',1)->count();
        $newusers = jobs::whereBetween('created_at', [$DaysAgo, Carbon::now()])->count();
        $data = [
                    'applications' => $applications,
                    'pending_interviews' => $pending_interviews,
                    'hairs' => $hairs,
                    'openjobs' => $openjobs,
                    'newusers' => $newusers,
                    'report_type' => 'Weekly',
                    'to' => Carbon::now(),
                    'from' => $DaysAgo
                ];

        $pdf = PDF::loadView('layouts.pdf_view', $data);
        return $pdf->download('weekly_report.pdf');
    }

    public function monthly(){
        $now = Carbon::now();
        $DaysAgo = $now->subDays(30);
        $applications = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->count();
        $pending_interviews = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->whereIn('status',[1,2,3])->count();
        $hairs = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->where('status',4)->count();
        $openjobs = jobs::where('is_active',1)->count();
        $newusers = jobs::whereBetween('created_at', [$DaysAgo, Carbon::now()])->count();
        $data = [
            'applications' => $applications,
            'pending_interviews' => $pending_interviews,
            'hairs' => $hairs,
            'openjobs' => $openjobs,
            'newusers' => $newusers,
            'report_type' => 'Weekly',
            'to' => Carbon::now(),
            'from' => $DaysAgo
        ];

        $pdf = PDF::loadView('layouts.pdf_view', $data);
        return $pdf->download('monthly_report.pdf');

    }

    public function yearly(){
        $now = Carbon::now();
        $DaysAgo = $now->subDays(365);
        $applications = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->count();
        $pending_interviews = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->whereIn('status',[1,2,3])->count();
        $hairs = apply_job::whereBetween('updated_at', [$DaysAgo, Carbon::now()])->where('status',4)->count();
        $openjobs = jobs::where('is_active',1)->count();
        $newusers = jobs::whereBetween('created_at', [$DaysAgo, Carbon::now()])->count();
        $data = [
            'applications' => $applications,
            'pending_interviews' => $pending_interviews,
            'hairs' => $hairs,
            'openjobs' => $openjobs,
            'newusers' => $newusers,
            'report_type' => 'Weekly',
            'to' => Carbon::now(),
            'from' => $DaysAgo
        ];

        $pdf = PDF::loadView('layouts.pdf_view', $data);
        return $pdf->download('yearly_report.pdf');

    }

}
