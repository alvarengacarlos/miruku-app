<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CowController extends Controller
{
    public function getCow($earring)
    {
        
        $validator = Validator::make(['earring' => $earring], [
            'earring' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        
        $model = new Cow();
        $result = $model->select($earring);

        if (!$result) {
            return response()->json('Cow not found', 404);
        }

        return response()->json([
            'earring' => $result->id,
            'weight' => $result->weight,
            'breed' => $result->breed,            
            'birthday' => $result->birthday
        ]);
    }

    public function postCow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'earring' => 'required|integer|gt:0',
            'weight' => 'required|numeric|gt:0',
            'breed' => 'required|max:100',
            'birthday' => 'required|date_format:"Y-m-d"|before_or_equal:'.\date('Y-m-d'),
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
    
        $earring = $request->input('earring');
        $weight = $request->input('weight');
        $breed = $request->input('breed');
        $birthday = $request->input('birthday');
        
        $model = new Cow();
        $model->insert($earring, $weight, $breed, $birthday);

        return response('');
    }

    public function putCow(Request $request, $earring)
    {
        $arr = array_merge($request->all(), ['earring' => $earring]);

        $validator = Validator::make($arr, [
            'earring' => 'required|integer|gt:0',
            'weight' => 'required|numeric|gt:0',
            'breed' => 'required|max:100',
            'birthday' => 'required|date_format:"Y-m-d"|before_or_equal:'.\date('Y-m-d'),
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }

        $weight = $request->input('weight');
        $breed = $request->input('breed');
        $birthday = $request->input('birthday');
        
        $model = new Cow();
        $result = $model->alter($earring, $weight, $breed, $birthday);
        
        if ($result == 404) {
            return response()->json('Cow not found', 404);
        }

        return response('');
    }

    public function deleteCow(int $earring)
    {
        $validator = Validator::make(['earring' => $earring], [
            'earring' => 'required|integer|gt:0',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 400);
        }
        
        $model = new Cow();
        $result = $model->del($earring);

        if ($result == 404) {
            return response()->json('Cow not found', 404);
        }

        return response('');
    }


}
