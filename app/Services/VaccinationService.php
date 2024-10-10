<?php

namespace App\Services;

use App\Models\Center;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class VaccinationService
{
    const WEEKDAYS = [0, 1, 2, 3, 4];

    public function getNextAvailableDate($centerId)
    {
        $center = Center::findOrFail($centerId);
        $limit = $center->limit;
        $scheduledDate = Carbon::now();

        while (true) {
            if (in_array($scheduledDate->dayOfWeek, self::WEEKDAYS)) {
                $existingCount = Vaccination::where('center_id', $centerId)
                    ->whereDate('scheduled_date', $scheduledDate->toDateString())
                    ->count();

                if ($existingCount < $limit) {
                    return $scheduledDate->toDateString();
                }
            }
            $scheduledDate->addDay();
        }
    }

    public function createVaccination(array $validatedData)
    {
        try {
            $scheduledDate = $this->getNextAvailableDate($validatedData['center']);
            $vaccination = Vaccination::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'nid' => $validatedData['nid'],
                'center_id' => $validatedData['center'],
                'scheduled_date' => $scheduledDate,
            ]);

            return [
                'data' => $vaccination,
                'status' => 200,
                'message' => 'Registration successful!',
            ];
        } catch (\Exception $e) {
            Log::error('Failed to register for NID: ' . $validatedData['nid'] . '. Error: ' . $e->getMessage());
            return [
                'data' => null,
                'status' => 500,
                'message' => 'Registration failed due to a server error. Please try again later.',
            ];
        }
    }
}
