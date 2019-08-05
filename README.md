# User-Management
package for user management
## This package require
You should used MongoDB
```shell
jenssegers/laravel-mongodb
```

Generated using comoser
```shell
composer require hideto-d-kurt/user-management
```
## Get all users
Example
```php
<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UserManagement\Users;

class UsersController extends Controller
{
    protected $users = null;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function getAllUsers()
    {
        $users = $this->users->getAllUser();
        return response()->json(['data' => $users]);
    }
}

```

## Set user logs
Example post log data
```json
{
    "id": "5d42a97d68285300074e4f42",
    "uri": "/home",
    "date_time": "1564739327"
}
```
Example function
```php
use UserManagement\UserLog;

class UsersController extends Controller
{
    protected $user_log = null;

    public function __construct()
    {
        $this->user_log = new UserLog();
    }
    
    public function setUserLog(Request $req)
    {
        $log_detail = $req->all();
        $this->user_log->setUserLog($log_detail);
        return response()->json(['data' => $log_detail]);
    }
}
```

## Get user by ID
Example
```php
public function getUserById($id)
{
    $users = new Users();
    $user = $users->getUserById($id);
    return response()->json(['data' => $user]);
}
```

Response
```json
{
    "data": {
        "_id": "5d42a97d68285300074e4f42",
        "name": "Hideto D Kurt",
        "email": "abc@gmail.com",
        "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
        "updated_at": "2019-08-01 08:57:33",
        "created_at": "2019-08-01 08:57:33"
    }
}
```

## Create User
Example pos data
```json
{
    "name": "Hideto D Kurt",
    "email": "abc@gmail.com",
    "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
    "updated_at": "2019-08-01T08:57:33Z",
    "created_at": "2019-08-01T08:57:33Z"
}
```
Password generate by 
```php
use Illuminate\Support\Facades\Hash;
/*-----------------------*/
'password' => Hash::make($data['password'])
```

Example code
```php
public function createUser(Request $req)
{
    $user       = $req->all();
    $user_class = new Users();
    $user       = $user_class->createUser($user);
    if($user) {
        return response()->json(['data' => $user, 'message' => 'Create User Success.']);
    } else {
        return response()->json(['data' => [], 'message' => 'Create User fail.']);
    }
}
```

Response Success
```json
{
    "data": {
        "_id": "5d42a97d68285300074e4f42",
        "name": "Hideto D Kurt",
        "email": "abc@gmail.com",
        "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
        "updated_at": "2019-08-01 08:57:33",
        "created_at": "2019-08-01 08:57:33"
    },
    "massage": "Create User Success."
}
```

Response Fail
```json
{
    "data": {},
    "massage": "Create User fail."
}
```