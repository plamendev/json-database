# json-flat
An attempt to create flat-file database solution around JSON, inspired by CodeIgniter's ActiveRecord implementation. It is suitable for small web sites.

If you like the idea please contribute to development by forking this project.
Thank you!

/// USAGE

+ Initialise class

$db = new Db('users.db');

+ Insert record

$user = array('name' => 'John Doe', 'email' => 'johndoe@example.com');
$db->insert($user);

+ Display records

$users = $db->get();
foreach($users as $user)
{
  echo $user['name'].', '.$user['email'].'<br>';
}

+ Update record

$db->where('name', 'John Doe');
$db->update( array('email' => 'johndoe@gmail.com') );

+ Delete record(s)

$db->where('name', 'John Doe');
$db->delete();


/// FUTURE DEVELOPMENT
+ Full CRUD implementation
+ Sorting (order_by etc.)
