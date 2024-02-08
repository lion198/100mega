<?php

namespace App\Model;
 use Nette\Security\IIdentity;


 class User implements IIdentity
 {
    private int $id;
    private string $login;
    private int $role;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

     /**
      * @param int $id
      * @param string $login
      * @param int $role
      */
     public function __construct(int $id, string $login, int $role)
     {
         $this->id = $id;
         $this->login = $login;
         $this->role = $role;
     }
     /** Static function  */
     /** dbObject to object User */
     public static function dbToObject($data) : User{
         return new User($data->id,$data->login,$data->role);
     }
     /** Function convert List of dbObject to array of User */
     public static function dbListToListObject($data) : array {
         $result = [];
         foreach ($data as $user){
             $result[] = User::dbToObject($user);
         }
         return $result;
     }
     /** Getters and setters */

     public function getId(): int
     {
         return $this->id;
     }

     public function setId(int $id): void
     {
         $this->id = $id;
     }

     public function getLogin(): string
     {
         return $this->login;
     }

     public function setLogin(string $login): void
     {
         $this->login = $login;
     }

     public function getRole(): int
     {
         return $this->role;
     }

     public function setRole(int $role): void
     {
         $this->role = $role;
     }


     function getRoles(): array{
         return [$this->role];
     }
 }