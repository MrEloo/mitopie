<?php

class CategorieAnimalManager extends AbstractManager
{
    public function getAllCatAnimal(): array
    {
        $selectAllCatAnimalQuery = $this->db->prepare('SELECT * FROM categories_animeaux');
        $selectAllCatAnimalQuery->execute();
        $categories_animeaux_data = $selectAllCatAnimalQuery->fetchAll(PDO::FETCH_ASSOC);


        if ($categories_animeaux_data) {

            $categories_animeaux_array = [];

            foreach ($categories_animeaux_data as $key => $categorie_animal_data) {
                $categorie = new CategorieAnimal($categorie_animal_data['nom'], $categorie_animal_data['media'], $categorie_animal_data['logo']);
                $categorie->setId($categorie_animal_data['id']);
                $categories_array[] = $categorie;
            }
            return $categories_array;
        } else {
            return null;
        }
    }

    public function getCatAnimalById($id): ?CategorieAnimal
    {
        $selectCatByIdQuery = $this->db->prepare('SELECT * FROM categories_animeaux WHERE id = :id');
        $parameters = ['id' => $id];
        $selectCatByIdQuery->execute($parameters);
        $categorie_data = $selectCatByIdQuery->fetch(PDO::FETCH_ASSOC);


        if ($categorie_data) {
            $categorie = new CategorieAnimal($categorie_data['nom'], $categorie_data['media'], $categorie_data['logo']);
            $categorie->setId($categorie_data['id']);
            return $categorie;
        } else {
            return null;
        }
    }

    public function supprimerCategorieVivant(int $id): void
    {
        $deleteQuery = $this->db->prepare('DELETE FROM categories_animeaux WHERE id = :id');
        $parameters = ['id' => $id];
        $deleteQuery->execute($parameters);
    }

    public function modifierCategorieVivant(int $id, string $nom, string $media): void
    {
        $updateQuery = $this->db->prepare('UPDATE categories_animeaux SET nom = :nom, media = :media WHERE id = :id');
        $parameters = [
            'id' => $id,
            'nom' => $nom,
            'media' => $media
        ];
        $updateQuery->execute($parameters);
    }

    public function ajouterCategorieVivant(string $nom, string $media): void
    {
        $insertQuery = $this->db->prepare('INSERT INTO categories_animeaux (nom, media) VALUES (:nom, :media)');
        $parameters = [
            'nom' => $nom,
            'media' => $media
        ];
        $insertQuery->execute($parameters);
    }
}
