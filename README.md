# User Management for Laravel
[![Latest Stable Version](https://poser.pugx.org/hideto-d-kurt/user-management/v/stable)](https://packagist.org/packages/hideto-d-kurt/user-management)
[![Total Downloads](https://poser.pugx.org/hideto-d-kurt/user-management/downloads)](https://packagist.org/packages/hideto-d-kurt/user-management)
[![License](https://poser.pugx.org/hideto-d-kurt/user-management/license)](https://packagist.org/packages/hideto-d-kurt/user-management)

# Requirements
You should used MongoDB
```
 * PHP >= 7.1.0
 * jenssegers/laravel-mongodb
```

# Installation
```shell
composer require hideto-d-kurt/user-management
```

# Usage
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
Example post data
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
    $user       = $user_class->createUser($user, 'email');
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

## Update User
Example post data
```json
{
    "_id": "5d42a97d68285300074e4f42",
    "name": "toshi",
    "email": "xxxxx@gmail.com",
    "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG"
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
public function updateUser(Request $req)
{
    $user = $req->all();
    $user = $this->users->updateUser($user, '_id');
    if($user) {
        return response()->json(['data' => $user, 'message' => 'Update User Success']);
    } else {
        return response()->json(['data' => [], 'message' => 'Update User fail.']);
    }
}
```

Response Success
```json
{
    "data": {
        "_id": "5d42a97d68285300074e4f42",
        "name": "toshi",
        "email": "xxxxx@gmail.com",
        "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
        "updated_at": "2019-08-05 03:59:38",
        "created_at": "2019-08-01 08:57:33"
    },
    "massage": "Update User Success."
}
```

Response Fail
```json
{
    "data": {},
    "massage": "Update User fail."
}
```

## Soft and Hard delete User
Example post data
```json
{
    "_id": "5d42a97d68285300074e4f42",
    "name": "toshi",
    "email": "xxxxx@gmail.com"
}
```

Example code for hard delete
```php
public function deleteUserHard(Request $req)
{
    $user = $req->all();
    $user = $this->users->deleteUserHard($user, '_id');
    if($user) {
        return response()->json(['data' => [], 'message' => 'Hard Delete User Success']);
    } else {
        return response()->json(['data' => [], 'message' => 'Hard Delete User fail.']);
    }
}
```

Response Success
```json
{
    "data": {},
    "massage": "Hard Delete User Success."
}
```

Response Fail
```json
{
    "data": {},
    "massage": "Hard Delete User fail."
}
```

Example code for soft delete
```php
public function deleteUserSoft(Request $req)
{
    $user = $req->all();
    $user = $this->users->deleteUserHard($user, '_id');
    if($user) {
        return response()->json(['data' => [], 'message' => 'Soft Delete User Success']);
    } else {
        return response()->json(['data' => [], 'message' => 'Soft Delete User fail.']);
    }
}
```

Response Success
```json
{
    "data": {},
    "massage": "Soft Delete User Success."
}
```

Response Fail
```json
{
    "data": {},
    "massage": "Soft Delete User fail."
}
```

## Get user by other key
Example
```php
public function getOneUserByUnique()
{
    $users = new Users();
    $user = $users->getUserById('email', 'abc@gmail.com');
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

## Get user by key and value and condition
Example
```php
public function getUserByCondition()
{
    $key = 'email';
    $value = '%gmail.com%';
    $condition = 'like';
    $user = $this->users->getUserByKeyAndCondition($key, $value, $condition);
    return response()->json(['data' => $user]);
}
```

Response
```json
{
    "data": [
        {
            "_id": "5d42a97d68285300074e4f42",
            "name": "Hideto D Kurt",
            "email": "xxxxx@gmail.com",
            "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
            "updated_at": "2019-08-01 08:57:33",
            "created_at": "2019-08-01 08:57:33"
        },
        {
            "_id": "5d47bf556828530007429b78",
            "name": "abc def",
            "email": "abc@gmail.com",
            "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POMJHG",
            "created_at": "2019-08-05 05:32:05",
            "updated_at": "2019-08-05 05:32:05"
        }
    ]
}
```

## User Login
Example post data
```json
{
    "_id": "5d42a97d68285300074e4f42",
    "name": "toshi",
    "email": "xxxxx@gmail.com",
    "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG"
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
public function loginUesr(Request $req)
{
    $user_login = new Users();
    $user = $req->all();
    $user = $user_login->userAuth($user, 'email', 'password');
    if($user) {
        return response()->json(['data' => $user, 'message' => 'Log in Success.']);
    } else {
        return response()->json(['data' => [], 'message' => 'Log in fail.']);
    }
}
```

Response Success
```json
{
    "data": {
        "_id": "5d42a97d68285300074e4f42",
        "name": "toshi",
        "email": "xxxxx@gmail.com",
        "password": "$2y$10$4Ft/HJveRZuYYMlQxEcuzuckvJhEvW94/K9IPqWaso8wXl0POCKHG",
        "created_at": "2019-08-01 08:57:33",
        "updated_at": "2019-08-05 09:37:52",
        "login_at": "2019-08-05 09:37:52"
    },
    "massage": "Log in Success."
}
```

Response Fail
```json
{
    "data": {},
    "massage": "Log in fail."
}
```

## License
[MIT](https://choosealicense.com/licenses/mit/)