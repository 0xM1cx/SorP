<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=smashorpass', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Fetch two random pictures with rating difference within a certain range
    public function getPeeps($ratingDifference = 400)
    {
        $query = "SELECT * FROM peeps ORDER BY RAND() LIMIT 2";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $peeps = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $selected = [];
        foreach ($peeps as $peep1) {
            foreach ($peeps as $peep2) {
                if ($peep1['id'] != $peep2['id'] && abs($peep1['rating'] - $peep2['rating']) <= $ratingDifference) {
                    $selected = [$peep1, $peep2];
                    break 2;
                }
            }
        }
        return $selected;
    }

    // Fetch a single picture by ID
    public function getPeepById($id)
    {
        $query = "SELECT * FROM peeps WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRating($id)
    {
        $query = "SELECT rating FROM peeps WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['rating'];
    }

    // Update rating
    public function updateRating($id, $newRating)
    {
        $query = "UPDATE peeps SET rating = :rating WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':rating' => $newRating, ':id' => $id]);
    }

    public function getRankedPeeps()
    {
        $query = "SELECT * FROM peeps ORDER BY rating DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
