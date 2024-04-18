<?php

class HoraireFermeManager extends AbstractManager
{
    public function getFarmHours(): array
    {
        $selectHorairesQuery = $this->db->prepare('SELECT * FROM horaires_ferme');
        $selectHorairesQuery->execute();
        $horaires_data = $selectHorairesQuery->fetchAll(PDO::FETCH_ASSOC);

        if ($horaires_data) {
            $horaire_array = [];

            foreach ($horaires_data as $key => $horaire_data) {
                $horaire = new HoraireFerme($horaire_data['jour'], $horaire_data['ouverture'], $horaire_data['fermeture']);
                $horaire->setId($horaire_data['id']);
                $horaire_array[] = $horaire;
            }
            return $horaire_array;
        } else {
            return null;
        }
    }
}
