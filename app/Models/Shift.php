<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        $today = (string) Carbon::today();
        $var = explode(' ', $today);
        
        return DB::table('shifts')
            ->join('categories', 'shifts.category_id', '=', 'categories.id')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'users.place', 'categories.priority', 'shifts.id', 'shifts.status')
            ->whereRaw("date(shifts.created_at) = '$var[0]'")
            /* ->where('shifts.status', '=', '1') */
            ->latest('shifts.updated_at', 'asc')
            ->take(5)
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

    public function scopeCanceledShifts(){

        $today = (string) Carbon::today();
        $var = explode(' ', $today);

        return $shiftListCanceled = DB::table('shifts')
            ->join('users', 'shifts.user_id', '=', 'users.id')
            ->select('shifts.ticket_code', 'shifts.id')
            ->where('shifts.status', '=', '0')
            ->whereRaw("date(shifts.created_at) = '$var[0]'")
            ->where('shifts.user_id', Auth::user()->id)
            ->get();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
