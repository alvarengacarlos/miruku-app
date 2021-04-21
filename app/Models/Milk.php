<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Milk extends Model
{   

    public function select(int $id)
    {
        $result = Milk::find($id);        

        return $result;
    }

    public function insert(int $earring, string $date, string $time, float $liters)
    {

        $milk = new Milk();
        $milk->cow_id = $earring;
        $milk->date = $date;
        $milk->time = $time;
        $milk->liters = $liters;
        
        try { 
            $milk->save();
        
        } catch (QueryException $e) {
            return 400;
        } 

        return 200;
    }

    public function del(int $id)
    {
        $milk = Milk::find($id);
        
        if (!$milk) {
            return 404;
        }

        $milk->delete();

        return 200;
    }
}