<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $pageTitle = 'Prayer Tracker';
        $today = null;
        $monthRecords = collect();
        $stats = [
            'streak' => 0,
            'month_percent' => 0,
            'today_count' => 0,
            'month_complete' => 0,
        ];

        if (Auth::check()) {
            try {
                $user = Auth::user();
                $today = Attendance::firstOrNew([
                    'user_id' => $user->id,
                    'date' => Carbon::today()->toDateString(),
                ]);
                $monthRecords = Attendance::where('user_id', $user->id)
                    ->whereYear('date', now()->year)
                    ->whereMonth('date', now()->month)
                    ->get()
                    ->keyBy(function ($row) {
                        return $row->date->format('Y-m-d');
                    });
                $stats = $this->buildStats($user->id, $today);
            } catch (\Throwable $e) {
                $today = null;
                $monthRecords = collect();
            }
        }

        return view(activeTemplate() . 'prayer.tracker', compact('pageTitle', 'today', 'monthRecords', 'stats'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $prayers = Attendance::PRAYERS;
        $data = $request->validate([
            'date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $record = Attendance::firstOrNew([
            'user_id' => Auth::id(),
            'date' => $data['date'] ?? Carbon::today()->toDateString(),
        ]);

        foreach ($prayers as $prayer) {
            $record->{$prayer} = $request->boolean($prayer);
        }
        $record->notes = $data['notes'] ?? $record->notes;
        $record->save();

        $notify[] = ['success', 'Prayer attendance saved.'];
        return back()->withNotify($notify);
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Login required'], 401);
        }

        $request->validate([
            'prayer' => 'required|in:' . implode(',', Attendance::PRAYERS),
            'date' => 'nullable|date',
        ]);

        $record = Attendance::firstOrNew([
            'user_id' => Auth::id(),
            'date' => $request->input('date', Carbon::today()->toDateString()),
        ]);

        $prayer = $request->prayer;
        $record->{$prayer} = !$record->{$prayer};
        $record->save();

        return response()->json([
            'success' => true,
            'prayer' => $prayer,
            'value' => (bool) $record->{$prayer},
            'today_count' => $record->obligatoryCount(),
            'complete' => $record->isComplete(),
            'stats' => $this->buildStats(Auth::id(), $record),
        ]);
    }

    protected function buildStats($userId, $today)
    {
        $monthRecords = Attendance::where('user_id', $userId)
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->get();

        $daysInMonth = now()->day;
        $possible = max($daysInMonth, 1) * 5;
        $done = $monthRecords->sum(function ($row) {
            return $row->obligatoryCount();
        });

        return [
            'streak' => $this->calculateStreak($userId),
            'month_percent' => $possible ? round(($done / $possible) * 100) : 0,
            'today_count' => $today ? $today->obligatoryCount() : 0,
            'month_complete' => $monthRecords->filter->isComplete()->count(),
        ];
    }

    protected function calculateStreak($userId)
    {
        $records = Attendance::where('user_id', $userId)
            ->where('date', '<=', Carbon::today()->toDateString())
            ->orderByDesc('date')
            ->get()
            ->keyBy(function ($row) {
                return $row->date->format('Y-m-d');
            });

        $streak = 0;
        $cursor = Carbon::today();
        if (!isset($records[$cursor->toDateString()]) || !$records[$cursor->toDateString()]->isComplete()) {
            $cursor->subDay();
        }

        while (isset($records[$cursor->toDateString()]) && $records[$cursor->toDateString()]->isComplete()) {
            $streak++;
            $cursor->subDay();
        }

        return $streak;
    }
}
