<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Statue;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function adminIndex()
    {
        $reports = Report::paginate(10); 
        $statues = Statue::all(); 
    
        return view('admin', compact('reports', 'statues')); 
    }
    
    public function updateStatus(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->statues_id = $request->input('status_id');
        $report->save();
    
        return response()->json(['success' => true]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'statues_id' => 'required|exists:statues,id',
        ]);

        // Find the report and update the status
        $report = Report::findOrFail($id);
        $report->statues_id = $request->statues_id;
        $report->save();

        return redirect()->route('admin.index')->with('success', 'Статус обновлён успешно!');
    }


    
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->paginate(10);
        return view('welcome', ['reports' => $reports]); 
    }

    public function create()
    {
        $services = Service::all();
        $statues = Statue::all();

        return view('request', compact('services', 'statues')); 
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'service_id' => 'required|exists:services,id',
            'payment' => 'required|in:cash,card', 
        ]);

        Log::info('Creating report with data:', $data);

        try {
            Report::create([
                'address' => $data['address'],
                'contact' => $data['contact'],
                'date' => $data['date'],
                'time' => $data['time'],
                'service_id' => $data['service_id'],
                'statues_id' => 1, 
                'user_id' => Auth::id(), 
                'payment' => $data['payment'],
            ]);

            Log::info('Report created successfully.');

            return redirect('/')->with('message', 'Создание заявки успешно!'); 
        } catch (\Exception $e) {
            Log::error('Error creating report: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Не удалось создать заявку.']);
        }
    }
}
