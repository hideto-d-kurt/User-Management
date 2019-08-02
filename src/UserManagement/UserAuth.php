<?php 

namespace UserManagement;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserAuth extends Eloquent 
{
    protected $collection = 'users';
    
    public static function getModel() {
        return new MenuModel();
    }

    public function getAllUsers()
    {
        $result = $this->get();
        return $result;
    }
}

