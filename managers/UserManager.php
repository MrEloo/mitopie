<?php

class UserManager extends AbstractManager
{
    public function getUserByEmail($email): ?User
    {
        $selectUserQuery = $this->db->prepare('SELECT * from users WHERE email = :email');
        $parameters = ['email' => $email];
        $selectUserQuery->execute($parameters);
        $user_data = $selectUserQuery->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {

            $user = new User($user_data['nom'], $user_data['prenom'], $user_data['email'], $user_data['password'], $user_data['telephone'], $user_data['adresse'], $user_data['code_postal'], $user_data['ville'], $user_data['newsletter']);
            $user->setId($user_data['id']);
            $user->setRole($user_data['role']);

            $_SESSION['connexion'] = 'autorise';

            return $user;
            dump($user);
        } else {
            return null;
        }
    }

    public function createUser($user): void
    {
        $insertUserQuery = $this->db->prepare('INSERT INTO users (nom, prenom, email, password, telephone, adresse, code_postal, ville, role) VALUES (:nom, :prenom, :email, :password, :telephone, :adresse, :code_postal, :ville, :role)');
        $parameters = [
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'telephone' => $user->getTelephone(),
            'adresse' => $user->getAdresse(),
            'code_postal' => $user->getCode_postal(),
            'ville' => $user->getVille(),
            'role' => 'USER'
        ];
        $insertUserQuery->execute($parameters);
    }

    public function getAllUser(): ?array
    {
        $selectUsersQuery = $this->db->prepare('SELECT * from users');
        $selectUsersQuery->execute();
        $users_data = $selectUsersQuery->fetchAll(PDO::FETCH_ASSOC);


        if ($users_data) {

            $users_array = [];
            foreach ($users_data as $key => $user_data) {
                $users = new User($user_data['nom'], $user_data['prenom'], $user_data['email'], $user_data['password'], $user_data['telephone'], $user_data['adresse'], $user_data['code_postal'], $user_data['ville'], $user_data['newsletter']);
                $users->setId($user_data['id']);
                $users->setRole($user_data['role']);
                $users_array[] = $users;
            }
            return $users_array;
        } else {
            return null;
        }
    }

    public function updateNewsletter(int $newsletter, int $id): void
    {
        $updateQuery = $this->db->prepare('UPDATE users SET newsletter = :newsletter WHERE id = :id ');
        $parameters = ['newsletter' => $newsletter, 'id' => $id];
        $updateQuery->execute($parameters);
    }
}
