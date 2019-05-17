<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class AclTableSeeder
 */
class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if ($this->command->confirm('Create roles for the user(s), default is webmaster and gebruiker', true)) {
            $inputRoles = $this->command->ask('Enter roles in comma separated format.', 'webmaster, gebruiker');
            $this->createRoleIfNotExists($inputRoles);
        }

        // There is only a authentication user needed.
        else {
            $this->createUser()->assignRole('gebruiker');
        }
    }

    /**
     * Function for creating the ACl role if it doesn't exist already in the storage.
     *
     * @param  string $roles    The one dimensional array for the given roles.
     * @return void
     */
    protected function createRoleIfNotExists(string $roles): void
    {
        foreach (explode(',', $roles) as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);
            $this->createUserWithRole($role); // Create one user for each role.
        }
    }

    /**
     * Method for creating a user without any ACL role.
     */
    protected function createUser(): User
    {
        return factory(User::class)->create(['password' => 'password']);
    }

    /**
     * Method for creating an new user in the database storage. + attaching ACL role.
     *
     * @param  Role $role The database entity from the given or created ACL role.
     * @return void
     */
    protected function createUserWithRole(Role $role): void
    {
        $user = $this->createUser()->assignRole($role->name);
        
        if ($this->roleIsWebmaster($role->name)) {
            $this->command->info('Here are your webmaster details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "password"');
        }
    }

    /**
    * Determine if the created role is webmaster or not.
    *
    * @param  string $role The name from the given role.
    * @return bool
    */
    protected function roleIsWebmaster(string $role): bool
    {
        return $role === 'webmaster';
    }
}
