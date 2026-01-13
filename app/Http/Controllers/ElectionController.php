<?php

namespace App\Http\Controllers;

use App\Models\PollingUnit;
use App\Models\Lga;
use App\Models\Party;
use App\Models\AnnouncedPuResults;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function pollingUnitResults($id)
    {
        $pollingUnit = PollingUnit::with('results')->findOrFail($id);
        return view('polling_unit_results', compact('pollingUnit'));
    }

    public function lgaResults(Request $request)
    {
        $lgas = Lga::all();
        $selectedLga = null;
        $partyTotals = [];

        if ($request->has('lga_id')) {
            $selectedLga = Lga::where('lga_id', $request->lga_id)->first();
            if ($selectedLga) {
                $pollingUnitIds = PollingUnit::where('lga_id', $selectedLga->lga_id)->pluck('uniqueid');
                $partyTotals = AnnouncedPuResults::whereIn('polling_unit_uniqueid', $pollingUnitIds)
                    ->select('party_abbreviation', \DB::raw('SUM(party_score) as total_score'))
                    ->groupBy('party_abbreviation')
                    ->get();
            }
        }

        return view('lga_results', compact('lgas', 'selectedLga', 'partyTotals'));
    }

    public function createResults()
    {
        $pollingUnits = PollingUnit::all();
        $parties = Party::all();
        return view('add_results', compact('pollingUnits', 'parties'));
    }

    public function storeResults(Request $request)
    {
        $validated = $request->validate([
            'polling_unit_uniqueid' => 'required|exists:polling_unit,uniqueid',
            'results' => 'required|array',
            'results.*' => 'required|integer|min:0',
        ]);

        foreach ($validated['results'] as $partyAbbr => $score) {
            AnnouncedPuResults::create([
                'polling_unit_uniqueid' => $validated['polling_unit_uniqueid'],
                'party_abbreviation' => $partyAbbr,
                'party_score' => $score,
                'entered_by_user' => 'admin',
                'date_entered' => now(),
                'user_ip_address' => $request->ip(),
            ]);
        }

        return redirect()->back()->with('success', 'Results stored successfully!');
    }
}
