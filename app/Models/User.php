<?php

namespace App\Models;

use Carbon\Carbon;
use App\Helpers\AgeRang;
use App\Helpers\Ranking;
use App\Enums\UserLevels;
use App\Traits\HasTickets;
use App\Traits\Notifiable;
use Illuminate\Support\Str;
use App\Services\RedisServices;
use App\Traits\GrantTicketsTrait;
//use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Multicaret\Acquaintances\Status;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Multicaret\Acquaintances\Interaction;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Multicaret\Acquaintances\Traits\Friendable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasTickets;
    use Friendable;


    protected $guarded = ['id','password'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'global_id',
//        'global_token',
//        'social_token',
//        'email',
//        'phone',
//        'first_name',
//        'last_name',
//        'image',
//        'date_of_birth',
//        'country_code',
//        'device_type',
//        'phone_verified',
//        'gender',
//        'fcm_token'
//    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'age',
        'global_token',
    ];

    protected $appends = [
        'user_age',
        'user_topics',
        'total_tickets',
        'grant_continually_play_ticket',
        'grant_daily_ticket_status',
        'level',
        'ScoresRoom',
        'HasGrandPrize',
        'full_name'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getLevelAttribute()
    {
        //   $levelsId = UserLevel::query()->pluck('id');

        //    foreach($levelsId as $key){
        //        Ranking::deleteUser('level_leaderboard_'.$key ,$this->id);
        //    }

        //    $level = UserLevels::getUserLevel($this->score,$this->id);
        //    Ranking::setUserScore('level_leaderboard_'. $level['id'] ,$this->id,$this->score);

        return UserLevels::getUserLevel($this->score,$this->id);
    }
    public function getUserAgeAttribute()
    {
        return (!empty($this->attributes['date_of_birth'])) ? Carbon::parse($this->attributes['date_of_birth'])->age : null;
    }
    public function getFullNameAttribute()
    {
        $number = $this->phone;
        $phon_new =  str_pad(substr($number, -3), strlen($number), '*', STR_PAD_LEFT);
    	return empty($this->first_name) ? $phon_new : $this->first_name . ' ' . $this->last_name ;
    }
    public function getUserTopicsAttribute()
    {
    //    $notification_open_new_room = 'tpc_open_room_true';
    //    $notification_open_new_question_true = 'tpc_open_question_true';

     $topices  = [
        'general' => config('larafirebase.env').'tpc_play_all',
        'end_room_now'=>config('larafirebase.env').'end_room_now',
        'country' => config('larafirebase.env')."tpc_country_" . Str::lower($this->country_code),
        'device' => config('larafirebase.env').'tpc_device_' . Str::lower($this->device_type),
        'age' => (!empty($this->user_age)) ? config('larafirebase.env').'tpc_age_' . AgeRang::getRangeBasedUserAge($this->user_age) : null,
        'open_room'=>config('larafirebase.env').'tpc_open_room_true',
        'open_question'=>config('larafirebase.env').'tpc_open_question_true',
    ];
        return collect($topices);
    }



    /***
     * Relations
     */

    /**
     * @param        $status
     * @param string $groupSlug
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findFriendshipsRelation($status = [], string $groupSlug = '', string $type = 'all')
    {
        $friendshipModelName = Interaction::getFriendshipModelName();
        $query = $friendshipModelName::where(function ($query) use ($type) {
            switch ($type) {
                case 'all':
                    $query->where(function ($q) {
                        $q->whereSender($this);
                    })->orWhere(function ($q) {
                        $q->whereRecipient($this);
                    });
                    break;
                case 'sender':
                    $query->where(function ($q) {
                        $q->whereSender($this);
                    });
                    break;
                case 'recipient':
                    $query->where(function ($q) {
                        $q->whereRecipient($this);
                    });
                    break;
            }
        })->whereGroup($this, $groupSlug);

        //if $status is passed, add where clause
        if (!is_null($status)) {
            $query->whereIn('status', $status);
        }

        return $query;
    }


    public function getFriendsWithFilter($groupSlug = '', $nameSearch = '')
    {
        return $this->getFriendsQueryBuilder($groupSlug)
            ->when(!empty($nameSearch), function ($query) use ($nameSearch) {
                return $query->where('first_name', 'like', "%{$nameSearch}%")
                    ->orwhere('last_name', 'like', "%{$nameSearch}%");
            });
    }

    public function getFriendRequests()
    {
        $friendships = $this->findFriendships(Status::PENDING, '')->get(['sender_id', 'recipient_id']);
        $senders = $friendships->pluck('sender_id')->all();
        return $this->where('id', '!=', $this->getKey())->whereIn('id', array_merge($senders));
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany(UserScore::class, 'user_id', 'id');
    }

    public function getRoomScoreAttribute()
    {
        return $this->points()
            ->where('room_id',$this->attributes['room_id'])
            ->where('available','=',1)
            ->selectRaw('*, sum(score) as sum')->first()
            ->sum;
       /*  $winer= DB::table('user_scores')->groupBy('user_id')
        ->selectRaw('*, sum(score) as sum')->orderByDesc('sum')
        ->get();
        dd($winer); */
    }

    public function totalUserScoresBasedRoom($roomId)
    {
        return $this->points()
            ->where('room_id', '=', $roomId)
            ->where('available', '=', 1)
            ->sum('score');
    }


    public function roomActivities()
    {
        return $this->hasMany(UserRoomActivity::class,'user_id');
    }

    public function getScoresRoomAttribute($roomId)
    {
        return (int) Ranking::getScore('room_leaderboard_'.$roomId,$this->id);
    }


    public function getHasGrandPrizeAttribute()
    {
        $data = LevelWinner::query()->with('user')->orderBy('created_at', 'desc')->first();
        return $data != null ? true : false ;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'user_id');
    }
}
