<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
      'name',
      'priority',
      'is_ready',
      'is_busy',
    ];

    /**
     * Relationship with the Calls.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
