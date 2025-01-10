<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'hobby_user');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_user', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friend_user', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_user');
    }

    /**
     * Get users who are not friends of the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNonFriends()
    {
        $friendIds = $this->friends()->pluck('friend_id')->toArray();
        $friendIds = array_merge($friendIds, $this->friendRequests()->pluck('user_id')->toArray());

        $friendIds[] = $this->id;

        return User::whereNotIn('id', $friendIds)->with('hobbies')->where('account_visible', 1)->paginate(10);
    }

    public function getNonFriendsQuery()
    {
        $friendIds = $this->friends()->pluck('friend_id')->toArray();
        $friendIds = array_merge($friendIds, $this->friendRequests()->pluck('user_id')->toArray());
        $friendIds[] = $this->id;

        return User::whereNotIn('id', $friendIds)->with('hobbies')->where('account_visible', 1);
    }

    // Fungsi buat request2 an friend

    // public function sendFriendRequest($userId, $friendId)
    // {
    //     $user = User::find($userId);
    //     $user->friends()->attach($friendId, ['status' => 'pending']);
    // }

    // public function acceptFriendRequest($userId, $friendId)
    // {
    //     $user = User::find($userId);
    //     $user->friendRequests()->updateExistingPivot($friendId, ['status' => 'accepted']);
    // }

    // public function removeFriend($userId, $friendId)
    // {
    //     $user = User::find($userId);
    //     $user->friends()->detach($friendId);
    // }

}
