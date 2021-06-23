<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Storage;

class User extends Authenticatable
{
    use Notifiable;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
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

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields );
        $this->save();
    }

    public function generatePassword($password)
    {
        if($password != null){
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function removeAvatar()
    {
        if($this->avatar != null){
            Storage::delete('uploads/' . $this->avatar);//удаляет прошлую картинку 
        }
    }

    public function upLoadAvatar($image)//пришла картинка
    {
        if($image == null) { return; }

        

        $filename = str_random(10) . '.' . $image->extension();// генерет название файла
        $image->storeAs('uploads', $filename);//сохраняет файл в папку uploads
        $this->avatar = $filename;//закидывает это значение в наше поле image
        $this->save();//сохраняет
    }

    public function getAvatar()
    {
        if($this->avatar == null)
        {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->avatar;
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
        $this->save();
    }

    public function toggleAdmin($value)
    {
        if($value == null)
        {
            return $this->makeNormal();
        }
        
        return $this->makeAdmin();
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unBan()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value == null)
        {
            return $this->unBan();
        }
        
        return $this->ban();
    }
}
