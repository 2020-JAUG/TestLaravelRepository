<?php

namespace App\Repositories;

use App\Exceptions\User\UserNotFoundException;
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
     * @return User El user encontrado en la db, si no lo encuentra lanza excepcion
     * @throws UserNotFoundException si no encuentra el user en la db
     */
    public function getOneUser(int $id): ?User
    {
        $userFound = null;
        try{
            $userFound = User::findOrFail($id);
        } catch (Exception $ex) {
            throw new UserNotFoundException(self::USER_NOT_FOUND_MESSAGE);
        }

        return $userFound;
    }

    /**
     * Busca un user en la db por nombre. Si no lo encuentra lanzará una excepción
     *
     * @param string $name nombre del user a buscar
     * @return User user encontrado en la base de datos, si no lo encuetra se lanza excepcion
     * @throws UserNotFoundException si no encuentra el user en la db
     */
    public function getUserByName(string $name): ?User
    {
        $userFound = null;
        try{
            $userFound = User::where('name', $name)->firstOrFail();
        }catch(Exception $ex) {
            throw new UserNotFoundException(self::USER_NOT_FOUND_MESSAGE);
        }
        return $userFound;
    }

    /**
     * Busca un usuario en la base de datos por email. Si no lo encuentra lanzará una excepción
     *
     * @param string $email email del usuario a buscar en la db
     * @return User user encontrado en la base de datos, si no lo encuentra lanzará excepcion
     * @throws UserNotFoundException si no encuentra el user en la db
     */
    public function getUserByEmail(string $email): ?User
    {
        $userFound = null;
        try{
            $userFound = User::where('email', $email)->firstOrFail();
        }catch(Exception $ex){
            throw new UserNotFoundException(self::USER_NOT_FOUND_MESSAGE);
        }
        return $userFound;
    }

    /**
     * Guarda un nuevo user en la db. Se hará rollback en caso de excepción durante la operación sobre la db
     *
     * @param User $user User que va a guardarse en la db
     * @return User User que se ha creado en la db
     * @throws Exception si ocurre un error durante la operacion
     */
    public function save(User $user): ?User
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
            throw $ex;
        }

        return $newUser;
    }

    /**
     * Actualiza user en la base de datos
     *
     * @param int $id Id del user a actualizar en la base de datos
     * @param User $user Datos nuevos del usuario que vamos a actualizar
     * @return User User que se ha actualizado
     * @throws Exception si ocurre un error durante la operacion
     */
    public function update(int $id, User $user): ?User
    {
        $userToUpdate = $this->getOneUser($id);
        DB::beginTransaction();
        try{
            foreach($user->toArray() as $key => $value)
            {
                if(isset($user[$key]))
                {
                    $userToUpdate->$key = $user[$key];
                }
            }
            $userToUpdate->update();
            DB::commit();
        }catch(Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return $userToUpdate;
    }

    /**
     * Elimina user de la db
     *
     * @param int $id Id del user a eliminar de la db
     * @return void
     * @throws Exception si ocurre un error durante la operacion
     */
    public function delete(int $id): void
    {
        $userToDelete = $this->getOneUser($id);
        DB::beginTransaction();
        try{
            $userToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
    }
}