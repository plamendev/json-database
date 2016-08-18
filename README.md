# json-flat
An attempt to create flat-file database around JSON, inspired by CodeIgniter's ActiveRecord implementation.
I have used this for a personal project and it works just fine.

If you like the idea please feel free to contribute to development!
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


/// FUTURE DEVELOPMENT
+ Full CRUD implementation
+ Sorting (order_by etc.)
