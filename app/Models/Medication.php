<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Medication extends Model
{   
    
    public function select(int $id)
    {
        $result = Medication::find($id);        

        return $result;
    }

    public function insert(int $earring, string $name, string $date, string $reason)
    {
        
        $medication = new Medication();

        $medication->cow_id = $earring;
        $medication->name = $name;
        $medication->date = $date;
        $medication->reason = $reason;

        try { 
            $medication->save();
        
        } catch (QueryException $e) {
            return 400;
        } 

        return 200;
    }

    public function del(int $id)
    {
        $medication = Medication::find($id);
        
        if (!$medication) {
            return 404;
        }

        $medication->delete();

        return 200;
    }
}