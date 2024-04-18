<?php

class ProduitManager extends AbstractManager
{
    public function getAllProductByCat($categorie_id): ?array
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits WHERE categorie_id = :categorie_id');
        $parameters = ['categorie_id' => $categorie_id];
        $selectProductByCatQuery->execute($parameters);
        $products_data = $selectProductByCatQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($products_data) {

            $products_array = [];

            $cm = new CategorieManager();

            foreach ($products_data as $key => $product_data) {
                $categorie = $cm->getCatById($product_data['categorie_id']);
                $product = new Produit($product_data['nom'], $product_data['prix'], $product_data['quantite'], $product_data['description'], $product_data['media'], $categorie);
                $product->setId($product_data['id']);

                $products_array[] = $product;
            }
            return $products_array;
        } else {
            return null;
        }
    }

    public function getAllProducts(): ?array
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits');
        $selectProductByCatQuery->execute();
        $products_data = $selectProductByCatQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($products_data) {

            $products_array = [];

            $cm = new CategorieManager();

            foreach ($products_data as $key => $product_data) {
                $categorie = $cm->getCatById($product_data['categorie_id']);
                $product = new Produit($product_data['nom'], $product_data['prix'], $product_data['quantite'], $product_data['description'], $product_data['media'], $categorie);
                $product->setId($product_data['id']);

                $products_array[] = $product;
            }
            return $products_array;
        } else {
            return null;
        }
    }

    public function getProductById(int $id): ?Produit
    {
        $selectProductByCatQuery = $this->db->prepare('SELECT * FROM produits WHERE id = :id');
        $parameters = ['id' => $id];
        $selectProductByCatQuery->execute($parameters);
        $product_data = $selectProductByCatQuery->fetch(PDO::FETCH_ASSOC);

        if ($product_data) {


            $cm = new CategorieManager();

            $categorie = $cm->getCatById($product_data['categorie_id']);
            $product = new Produit($product_data['nom'], $product_data['prix'], $product_data['quantite'], $product_data['description'], $product_data['media'], $categorie);
            $product->setId($product_data['id']);

            return $product;
        } else {
            return null;
        }
    }
    public function supprimerProduit(int $id): void
    {
        $deleteQuery = $this->db->prepare('DELETE FROM produits WHERE id = :id');
        $parameters = ['id' => $id];
        $deleteQuery->execute($parameters);
    }

    public function modifierProduit(string $nom, string $prix, string $quantite, string $description, string $media, int $categorie_id, int $id): void
    {
        $updateQuery = $this->db->prepare('UPDATE produits SET nom = :nom, prix = :prix, quantite = :quantite, description = :description, media = :media, categorie_id = :categorie_id WHERE id = :id');
        $parameters = [
            'nom' => $nom,
            'prix' => $prix,
            'quantite' => $quantite,
            'description' => $description,
            'media' => $media,
            'categorie_id' => $categorie_id,
            'id' => $id
        ];
        $updateQuery->execute($parameters);
    }

    public function ajouterProduit(?string $nom, ?string $prix, ?string $quantite, ?string $description, ?string $media, ?int $categorie_id): void
    {
        $insertQuery = $this->db->prepare('INSERT INTO produits (nom, prix, quantite, description, media, categorie_id) VALUES (:nom, :prix, :quantite, :description, :media, :categorie_id)');
        $parameters = [
            'nom' => $nom,
            'prix' => $prix,
            'quantite' => $quantite,
            'description' => $description,
            'media' => $media,
            'categorie_id' => $categorie_id
        ];
        $insertQuery->execute($parameters);
    }
}
