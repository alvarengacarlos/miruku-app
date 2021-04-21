<?php

namespace App\Http\Controllers;

use App\Models\Milk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MilkController extends Controller
{
    public function getMilk($id)
    {
        
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        
        $model = new Milk();
        $result = $model->select($id);

        if (!$result) {
            return response()->json('Milk not found', 404);
        }

        return response()->json([
            'id' => $result->id,
            'date' => $result->date,
            'time' => $result->time,
            'liters' => $result->liters
        ]);
    }

    public function postMilk(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'earring' => 'required|integer|gt:0',
            'date' => 'required|date_format:"Y-m-d"|before_or_equal:'.\date('Y-m-d').'|after_or_equal:'.\date('Y-m-d', strtotime('-7 days')),
            'time' => 'required|date_format:"H:i:s"|before_or_equal:'.\date('H:i:s'),
            'liters' => 'required|numeric|gt:0',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
    
        $earring = $request->input('earring');
        $date = $request->input('date');
        $time = $request->input('time');
        $liters = $request->input('liters');
        
        
        $model = new Milk();
        $result = $model->insert($earring, $date, $time, $liters);

        if ($result == 400) {
            return response()->json('Cow not exists', 400);
        }

        return response('');
    }

    public function deleteMilk(int $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        
        $model = new Milk();
        $result = $model->del($id);

        if ($result == 404) {
            return response()->json('Milk not found', 404);
        }

        return response('');
    }


}
