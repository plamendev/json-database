# json-flat
An attempt to create flat-file database solution around JSON, inspired by CodeIgniter's ActiveRecord implementation. It is suitable for small web sites.

If you like the idea please contribute to development by forking this project.
Thank you!

Usage
--------------------------------------

+ Initialise class

``` 
$db = new Db('users.db');
```

+ Insert record
```
$user = array('name' => 'John Doe', 'email' => 'johndoe@example.com');
$db->insert($user);
```

+ Display records
```
$users = $db->get();
foreach($users as $user)
{
  echo $user['name'].', '.$user['email'].'<br>';
}
```
+ Fetch selected records and sort by a given field in an ascendant ('ASC') or descendant ('DESC') manner.
```
$db->where('name', 'John');
$db->order_by('DOB', 'DESC');
$db->get();
```
+ Update record
```
$db->where('name', 'John Doe');
$db->update( array('email' => 'johndoe@gmail.com') );
```
+ Delete record(s)
```
$db->where('name', 'John Doe');
$db->delete();
```

Future Development
--------------------------------------
+ Full CRUD implementation
+ Schema definition
+ Optimize speed and file manipulation
