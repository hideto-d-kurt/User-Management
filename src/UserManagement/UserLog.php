<?php 

namespace UserManagement;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserLog extends Eloquent 
{
    protected $collection = 'user_log';
    
    public static function getModel() {
        return new UserLog();
    }

    public static function setUserLog($data)
    {
        self::insert($data);
        return true;
    }
}

