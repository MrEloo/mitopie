<?php

class EvenementManager extends AbstractManager
{
    public function getEvenements(): ?array
    {
        $selectEvementQuery = $this->db->prepare('SELECT * FROM evenements');
        $selectEvementQuery->execute();
        $evenements_data = $selectEvementQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($evenements_data) {
            $evenements_array = [];
            foreach ($evenements_data as $key => $evenement_data) {
                $evenement = new Evenement($evenement_data['titre'], $evenement_data['description']);
                $evenement->setId($evenement_data['id']);
                $evenements_array[] = $evenement;
            }
            return $evenements_array;
        } else {
            return null;
        }
    }

    public function getEvenementById(int $id): ?Evenement
    {
        $selectEvementQuery = $this->db->prepare('SELECT * FROM evenements WHERE id = :id');
        $parameters = ['id' => $id];
        $selectEvementQuery->execute($parameters);
        $evenement_data = $selectEvementQuery->fetch(PDO::FETCH_ASSOC);

        if ($evenement_data) {

            $evenement = new Evenement($evenement_data['titre'], $evenement_data['description']);
            $evenement->setId($evenement_data['id']);
            return $evenement;
        } else {
            return null;
        }
    }

    public function supprimerEvenement(int $id): void
    {
        $deleteQuery = $this->db->prepare('DELETE FROM evenements WHERE id = :id');
        $parameters = ['id' => $id];
        $deleteQuery->execute($parameters);
    }

    public function ajouterEvenement(string $titre, string $description): void
    {
        $insertQuery = $this->db->prepare('INSERT INTO evenements (titre, description) VALUES (:titre, :description)');
        $parameters = [
            'titre' => $titre,
            'description' => $description
        ];
        $insertQuery->execute($parameters);
    }

    public function modifierEvenement(int $id, string $titre, string $description): void
    {
        $updateQuery = $this->db->prepare('UPDATE evenements SET titre = :titre, description = :description WHERE id = :id');
        $parameters = [
            'id' => $id,
            'titre' => $titre,
            'description' => $description
        ];
        $updateQuery->execute($parameters);
    }
}
