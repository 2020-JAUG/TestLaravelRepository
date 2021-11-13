<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class UserRepositoryImpl implements UserRepositoryInterface
{
    private const USER_NOT_FOUND_MESSAGE = "User not found in DB";
    private const INTERNAL_ERROR_MESSAGE = "Something went wrong";
    /**
     * Busca todos los usuarios en la base de datos y los retorna
     *
     * @return Collection<mixed, App\Model\User> Colección de usuarios en la base de datos
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Busca un usuario por id. Si no lo encuentra lanzará una excepción y se retornará null al controlador
     *
     * @param int $id id del user a buscar
     * @return User El user encontrado en la db, o null si no lo encuentra
     */
    public function getOneUser(int $id): User
    {
        $userFound = null;
        try{
            $userFound = User::findOrFail($id);
        } catch (Exception $ex) {
            return self::USER_NOT_FOUND_MESSAGE;
        }

        return $userFound;
    }

    /**
     * Busca un user en la db por nombre. Si no lo encuentra lanzará una excepción y retornará null al controlador
     *
     * @param string $name nombre del user a buscar
     * @return User user encontrado en la base de datos o null si no lo encuentra
     */
    public function getUserByName(string $name): User
    {
        $userFound = null;
        try{
            $userFound = User::where('name', $name)->get();
        }catch(Exception $ex) {
            return self::USER_NOT_FOUND_MESSAGE;
        }
        return $userFound;
    }

    /**
     * Busca un usuario en la base de datos por email. Si no lo encuentra lanzará una excepción y retornará null
     *
     * @param string $email email del usuario a buscar en la db
     * @return User user encontrado en la base de datos o null si no lo encuentra
     */
    public function getUserByEmail(string $email): User
    {
        $userFound = null;
        try{
            $userFound = User::where('email', $email)->get();
        }catch(Exception $ex){
            return self::USER_NOT_FOUND_MESSAGE;
        }
        return $userFound;
    }

    /**
     * Guarda un nuevo user en la db. Se hará rollback en caso de excepción durante la operación sobre la db
     *
     * @param User $user User que va a guardarse en la db
     * @return User User que se ha creado en la db
     */
    public function save(User $user): User
    {
        $newUser = null;
        DB::beginTransaction();
        try{
            $newUser = $user;
            $newUser->password = Hash::make($user->password);
            $newUser->save();

            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return self::INTERNAL_ERROR_MESSAGE;
        }

        return $newUser;
    }

    /**
     * Actualiza user en la base de datos
     *
     * @param int $id Id del user a actualizar en la base de datos
     * @param User $user Datos nuevos del usuario que vamos a actualizar
     * @return User User que se ha actualizado
     */
    public function update(int $id, User $user): User
    {
        $userToUpdate = $this->getOneUser($id);
        DB::beginTransaction();
        try{
            if(isset($user->name)) {
                $userToUpdate->name = $user->name;
            }
            if(isset($user->email)) {
                $userToUpdate->email = $user->email;
            }
            if(isset($user->password)) {
                $userToUpdate->password = Hash::make($user->password);
            }
            $userToUpdate->update();
            DB::commit();
        }catch(Exception $ex) {
            DB::rollBack();
            return self::INTERNAL_ERROR_MESSAGE;
        }
        return $userToUpdate;
    }

    public function delete(int $id): ?string
    {
        $userToDelete = $this->getOneUser($id);
        DB::beginTransaction();
        try{
            $userToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return self::INTERNAL_ERROR_MESSAGE;
        }
    }
}