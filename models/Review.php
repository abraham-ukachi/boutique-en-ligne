<?php

namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use PDO;

class Review extends Database
{
    private ?int $user_id = null;
    private ?string $comment = null;
    private ?int $ratings = null;
    private ?\DateTime $created_at = null;


    public function __construct(){
        parent::__construct();
        $this->dbConnect();
    }

    /** Return reviews of product selected
     * @return array $result
     */
    public function getReview($id){
        $sql = "SELECT comment FROM comments WHERE product_id = $id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute();
        $result = $sql_exe->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insertReview($comment, $user_id, $product_id, $ratings, $created_at){

        $sql = "INSERT INTO `comments` (comment, user_id, product_id, ratings, created_at) 
                VALUES (:comment, :user_id, :product_id, :ratings, :created_at)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'comment' => $comment,
            'user_id' => $user_id,
            'product_id' => $product_id,
            'ratings' => $ratings,
            'created_at' => $created_at
        ]);
    }

}