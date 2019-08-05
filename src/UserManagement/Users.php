<?php 

namespace UserManagement;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use ArrToArr\RemoveMongoID;

class Users extends Eloquent 
{
    protected $collection = 'users';
    
    public static function getModel() {
        return new Users();
    }

    public static function getAllUser()
    {
        $arrToarr = new RemoveMongoID();
        $result = self::get();
        $result = json_decode($result, true);
        $result = $arrToarr->removeMongoId($result);
        return $result;
    }

    public static function getUserById($id)
    {
        $user = self::where('_id', '=', $id)->first();
        $user = json_decode($user, true);
        return $user;
    }

    public static function createUser($user)
    {
        if(self::insert($user)) {
            $user = self::where('email', '=', $user['email'])->first();
            return $user;
        } else {
            return false;
        }
    }
}

