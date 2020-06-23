<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','first_name','last_name','username', 'password','avatar','token','role_id','extra'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullName()
    {
        return $this->first_name." ".$this->last_name;
    }


    function isAdmin()
    {
        return $this->role_id==1?true:false;
    }

    function isSeller()
    {
        return $this->role_id==2?true:false;
    }

    function isAgent()
    {
        return $this->role_id==3?true:false;
    }

    function isCustomer()
    {
        return $this->role_id==4?true:false;
    }




    public static function checkUserExiste(\Telegram\Bot\Objects\User $user)
    {
        if(User::where('id','=',$user->getId())->get()->count()==0)
        {
            $customerRole = Role::whereName('customer')->first();
            $user=User::create([
                'id'                             => $user->getId(),
                'first_name'                     => $user->getFirstName(),
                'last_name'                      => $user->getLastName(),
                'username'                       => $user->getUsername(),
                'password'                       => Hash::make('1234'),
                'token'                          => Str::random(64),
                'role_id'                        => $customerRole->id,
                'activated'                      => true,
            ]);
            $user->avatar=File::getUserProfilePhotoPath($user);
            $user->save();
        }
    }


    public static function getSellers()
    {
        $sellerRole = Role::whereName('seller')->first();
        return User::where('role_id',$sellerRole->id)->get();
    }

    public static function getCustomers()
    {
        $customerRole = Role::whereName('customer')->first();
        return User::where('role_id',$customerRole->id)->get();
    }

    public function chatCount()
    {
        return Chat::where('operator_id',$this->id)->orwhere('user_id',$this->id)->count();
    }

    public function sendMessage($message,$keyboard=null)
    {
        Telegram::sendMessage([
            'chat_id' => $this->id,
            // 'text' => $text
            'text' => $message

        ]);
    }


}
