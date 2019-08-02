# User-Management
package for user management
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
