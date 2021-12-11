<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ModelHelper;

class Employee extends Model
{
	use ModelHelper;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'company_id'
    ];

    public $filterable = [
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

    //====================== Scopes Section================================
    public function scopeDateCreationFilter($query, $from, $to){
        return $query->whereBetween('created_at',[$from, $to]);
    }

    public function scopeColumnFilter($query){
        $this->filterModel($query, $this);
    }
    //=====================================================================
}