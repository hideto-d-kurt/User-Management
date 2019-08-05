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

    public static function getOneUserByUnique($search_key, $value)
    {
        $user = self::where($search_key, '=', $value)->first();
        $user = json_decode($user, true);
        return $user;
    }

    public static function getUserByKeyAndCondition($search_key, $value, $condition)
    {
        $user = self::where($search_key, $condition, $value)->get();
        $user = json_decode($user, true);
        return $user;
    }

    public static function createUser($user, $search_key)
    {
        if(self::insert($user)) {
            $user = self::where($search_key, '=', $user[$search_key])->first();
            $user->created_at = new \DateTime();
            $user->save();
            $user = self::where($search_key, '=', $user[$search_key])->first();
            return $user;
        } else {
            return false;
        }
    }

    public static function updateUser($user, $search_key)
    {
        $user_update = self::where($search_key, '=', $user[$search_key])->first();
        foreach($user as $key => $val) {
            if($key != "_id") {
                $user_update->$key = $user[$key];
            }
        }
        if($user_update->save()) {
            $user = self::where($search_key, '=', $user[$search_key])->first();
            return $user;
        } else {
            return false;
        }
    }

    public static function deleteUserHard($user, $search_key)
    {
        $user = self::where($search_key, '=', $user[$search_key])->first();
        if($user->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteUserSoft($user, $search_key)
    {
        $user_update = self::where($search_key, '=', $user[$search_key])->first();
        $user_update->deleted_at = new \DateTime();
        if($user_update->save()) {
            return true;
        } else {
            return false;
        }
    }

    public static function userAuth($user, $username_key, $password_key)
    {
        $user_auth = self::where($username_key, '=', $user[$username_key])->where($password_key, '=', $user[$password_key])->first();
        $user_auth->login_at = new \DateTime();
        if($user_auth->save()) {
            return $user_auth;
        } else {
            return false;
        }
    }

    public static function userAuth($user, $username_key, $password_key)
    {
        $user_auth = self::where($username_key, '=', $user[$username_key])->where($password_key, '=', $user[$password_key])->first();
        $user_auth->login_at = (new \DateTime())->format('Y-m-d H:i:s');
        if($user_auth->save()) {
            return $user_auth;
        } else {
            return false;
        }
    }
}

