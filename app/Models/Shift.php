<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_code', 'date_time', 'category_id', 'user_id'];


    public function scopeQueueShiftList(){
        return DB::table('shifts')
            ->where('user_id', null)
            ->count();
    }
   
    public function scopeCurrentListOfShifts(){
        
        return DB::table('shifts')
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
            ->where('shifts.status', '=', '1')
            ->latest('shifts.updated_at', 'asc')
            ->get();
    }

    public function scopeLatestShiftCalledByCashier(){
        return DB::table('shifts')
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
            ->where('shifts.status', '=', '1')
            ->where('shifts.user_id', '=', Auth::user()->id)
            ->latest('shifts.updated_at', 'asc')
            ->take(1)
            ->get(); 
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
