<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccineController extends Controller
{
    public function getVaccine($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }        

        $model = new Vaccine();
        $result = $model->select($id);

        if (!$result) {
            return response()->json('Vaccine not found', 404);
        }

        return response()->json([
            'id' => $result->id,
            'earring' => $result->cow_id,
            'name' => $result->name,
            'date' => $result->date,            
            'reason' => $result->reason
        ]);
    }

    public function postVaccine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'earring' => 'required|integer|gt:0',
            'name' => 'required|max:100',
            'date' => 'required|date_format:"Y-m-d"|before_or_equal:'.\date('Y-m-d'),
            'reason' => 'required|max:255',            
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
    
        $earring = $request->input('earring');
        $name = $request->input('name');
        $date = $request->input('date');
        $reason = $request->input('reason');
        
        $model = new Vaccine();
        $result = $model->insert($earring, $name, $date, $reason);

        if ($result == 400) {
            return response()->json('Cow not exists', 400);
        }

        return response('');
    }

    public function deleteVaccine(int $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        
        $model = new Vaccine();
        $result = $model->del($id);

        if ($result == 404) {
            return response()->json('Vaccine not found', 404);
        }

        return response('');
    }
}
