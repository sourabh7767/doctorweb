<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSearch extends Model
{
    use HasFactory;

    public function customTags()
    {
        return $this->hasMany(CustomSearchTag::class,'custom_search_id','id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public static function getColumnForSorting($value){

        $list = [
            0=>'id',
            1=>'title',
            2=>'craeted_at',
            3=>'updated_at',
        ];

        return isset($list[$value])?$list[$value]:"";
    }
    public function getAllCards($request = null,$flag = false)
    {
        // dd($request->all());
        // $columnNumber = $request['order'][0]['column'];
        // $order = $request['order'][0]['dir'];

        // $column = self::getColumnForSorting($columnNumber);

        // if($columnNumber == 0){
        //     $order = "desc";
        // }

        // if(empty($column)){
        //     $column = 'id';
        // }
        $query = self::query()->where('user_id','!=',auth()->user()->id)->with('user');

        if(!empty($request)){

            // $search = $request['search']['value'];

            // if(!empty($search)){
            //      $query->where(function ($query) use($request,$search){
            //             $query ->orWhere( 'title', 'LIKE', '%'. $search .'%')
            //                 ->orWhere('created_at', 'LIKE', '%' . $search . '%');

            //         });
                 if($flag)
                    return $query->count();
            // }

            // $start =  $request['start'];
            // $length = $request['length'];
            // $query->offset($start)->limit($length);


        }

        $query = $query->get();
        return $query;
    }
}
