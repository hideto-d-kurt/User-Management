# User-Management
package for user management
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
