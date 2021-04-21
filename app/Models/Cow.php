<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{   

    protected $fillable = ['id', 'weight', 'breed', 'birthday'];

    public function select(int $earring)
    {
        $result = Cow::find($earring);        

        return $result;
    }

    public function insert(int $earring, float $weight, string $breed, string $birthday)
    {
        
        $cow = Cow::firstOrCreate(
            ['id' => $earring],
            ['weight' => $weight, 'breed' => $breed, 'birthday' => $birthday]
        );
        
    }

    public function alter(int $earring, float $weight, string $breed, string $birthday)
    {
        $cow = Cow::find($earring);

        if (!$cow) {
            return 404;
        }

        $cow->weight = $weight;
        $cow->breed = $breed;
        $cow->birthday = $birthday;

        $cow->save();

        return 200;
    }

    public function del(int $earring)
    {
        $cow = Cow::find($earring);
        
        if (!$cow) {
            return 404;
        }

        $cow->delete();

        return 200;
    }
}