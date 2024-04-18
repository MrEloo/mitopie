<?php

class ProduitVivantManager extends AbstractManager
{
    public function getProductsByCat($categorie_animal_id): ?array
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits_vivants WHERE categorie_animal_id = :categorie_animal_id');
        $parameters = ['categorie_animal_id' => $categorie_animal_id];
        $selectProductByCatQuery->execute($parameters);
        $products_alive_data = $selectProductByCatQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($products_alive_data) {

            $products_alive_array = [];

            $cam = new CategorieAnimalManager();

            foreach ($products_alive_data as $key => $product_alive_data) {
                $categorie_animal = $cam->getCatAnimalById($product_alive_data['categorie_animal_id']);
                $product_alive = new ProduitVivant($product_alive_data['nom'], $product_alive_data['prix'], $product_alive_data['description'], $categorie_animal, $product_alive_data['media']);
                $product_alive->setId($product_alive_data['id']);

                $products_alive_array[] = $product_alive;
            }
            return $products_alive_array;
        } else {
            return null;
        }
    }

    public function getProductsAlives(): ?array
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits_vivants');
        $selectProductByCatQuery->execute();
        $products_alive_data = $selectProductByCatQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($products_alive_data) {

            $products_alive_array = [];

            $cam = new CategorieAnimalManager();

            foreach ($products_alive_data as $key => $product_alive_data) {
                $categorie_animal = $cam->getCatAnimalById($product_alive_data['categorie_animal_id']);
                $product_alive = new ProduitVivant($product_alive_data['nom'], $product_alive_data['prix'], $product_alive_data['description'], $categorie_animal, $product_alive_data['media']);
                $product_alive->setId($product_alive_data['id']);

                $products_alive_array[] = $product_alive;
            }
            return $products_alive_array;
        } else {
            return null;
        }
    }

    public function getProductAliveById(int $id): ?ProduitVivant
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits_vivants WHERE id = :id');
        $parameters = ['id' => $id];
        $selectProductByCatQuery->execute($parameters);
        $product_alive_data = $selectProductByCatQuery->fetch(PDO::FETCH_ASSOC);

        if ($product_alive_data) {


            $cam = new CategorieAnimalManager();

            $categorie_animal = $cam->getCatAnimalById($product_alive_data['categorie_animal_id']);
            $product_alive = new ProduitVivant($product_alive_data['nom'], $product_alive_data['prix'], $product_alive_data['description'], $categorie_animal, $product_alive_data['media']);
            $product_alive->setId($product_alive_data['id']);

            return $product_alive;
        } else {
            return null;
        }
    }

    public function supprimerProduitVivant(int $id): void
    {
        $deleteQuery = $this->db->prepare('DELETE FROM produits_vivants WHERE id = :id');
        $parameters = ['id' => $id];
        $deleteQuery->execute($parameters);
    }

    public function modifierProduitVivant(string $nom, string $prix, string $description, string $media, int $categorie_animal_id, int $id): void
    {
        $updateQuery = $this->db->prepare('UPDATE produits_vivants SET nom = :nom, prix = :prix, description = :description, categorie_animal_id = :categorie_animal_id, media = :media WHERE id = :id');
        $parameters = [
            'nom' => $nom,
            'prix' => $prix,
            'description' => $description,
            'categorie_animal_id' => $categorie_animal_id,
            'media' => $media,
            'id' => $id
        ];
        $updateQuery->execute($parameters);
    }



    public function ajouterProduitVivant(string $nom, string $prix, string $description, string $media, int $categorie_animal_id): void
    {
        $insertQuery = $this->db->prepare('INSERT INTO produits_vivants (nom, prix, description, categorie_animal_id, media) VALUES (:nom, :prix, :description, :categorie_animal_id, :media)');
        $parameters = [
            'nom' => $nom,
            'prix' => $prix,
            'description' => $description,
            'categorie_animal_id' => $categorie_animal_id,
            'media' => $media
        ];
        $insertQuery->execute($parameters);
    }
}
