<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Vaccine extends Model
{   


    public function select(int $id)
    {
        $result = Vaccine::find($id);        

        return $result;
    }

    public function insert(int $earring, string $name, string $date, string $reason)
    {
        
        $vaccine = new Vaccine();

        $vaccine->cow_id = $earring;
        $vaccine->name = $name;
        $vaccine->date = $date;
        $vaccine->reason = $reason;

        try { 
            $vaccine->save();
        
        } catch (QueryException $e) {
            return 400;
        } 

        return 200;
    }

    public function del(int $id)
    {
        $vaccine = Vaccine::find($id);
        
        if (!$vaccine) {
            return 404;
        }

        $vaccine->delete();

        return 200;
    }
}