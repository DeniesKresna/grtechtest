<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'company_id'
    ];

    /**
     * Get the company
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function getFullNameAttribute(){
        return $this->firstname." ".$this->lastname;
    }

    public function getCompanyNameAttribute(){
        if($this->company()->exists())
            return $this->company->name;
        return "-";
    }
}