<?php

class CategorieManager extends AbstractManager
{
    public function getAllCat(): ?array
    {
        $selectAllCatQuery = $this->db->prepare('SELECT * FROM categories');
        $selectAllCatQuery->execute();
        $categories_data = $selectAllCatQuery->fetchAll(PDO::FETCH_ASSOC);


        if ($categories_data) {

            $categories_array = [];

            foreach ($categories_data as $key => $categorie_data) {
                $categorie = new Categorie($categorie_data['nom'], $categorie_data['media']);
                $categorie->setId($categorie_data['id']);
                $categories_array[] = $categorie;
            }
            return $categories_array;
        } else {
            return null;
        }
    }

    public function getCatById($id): ?Categorie
    {
        $selectCatByIdQuery = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $parameters = ['id' => $id];
        $selectCatByIdQuery->execute($parameters);
        $categorie_data = $selectCatByIdQuery->fetch(PDO::FETCH_ASSOC);


        if ($categorie_data) {
            $categorie = new Categorie($categorie_data['nom'], $categorie_data['media']);
            $categorie->setId($categorie_data['id']);
            return $categorie;
        } else {
            return null;
        }
    }

    public function supprimerCategorie(int $id): void
    {
        $deleteQuery = $this->db->prepare('DELETE FROM categories WHERE id = :id');
        $parameters = ['id' => $id];
        $deleteQuery->execute($parameters);
    }

    public function modifierCategorie(int $id, string $nom, string $media): void
    {
        $updateQuery = $this->db->prepare('UPDATE categories SET nom = :nom, media = :media WHERE id = :id');
        $parameters = [
            'id' => $id,
            'nom' => $nom,
            'media' => $media
        ];
        $updateQuery->execute($parameters);
    }

    public function ajouterCategorie(string $nom, string $media): void
    {
        $insertQuery = $this->db->prepare('INSERT INTO categories (nom, media) VALUES (:nom, :media)');
        $parameters = [
            'nom' => $nom,
            'media' => $media
        ];
        $insertQuery->execute($parameters);
    }
}
