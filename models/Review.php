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
    public function getReviewsByProductId($productId){
        $sql = "SELECT * 
                FROM comments  
                INNER JOIN users 
                ON  users.id = comments.user_id
                INNER JOIN products
                ON products.id = comments.product_id
                WHERE product_id = $productId";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute();
        $result = $sql_exe->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $comment){
            print_r($comment['firstname']);
            print_r($comment['lastname']);
            print_r($comment['name']);
            print_r($comment['comment']);
            print_r($comment['ratings']);
            print_r($comment['created_at']);
        }
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

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     * @return Review
     */
    public function setUserId(?int $user_id): Review
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return Review
     */
    public function setComment(?string $comment): Review
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRatings(): ?int
    {
        return $this->ratings;
    }

    /**
     * @param int|null $ratings
     * @return Review
     */
    public function setRatings(?int $ratings): Review
    {
        $this->ratings = $ratings;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime|null $created_at
     * @return Review
     */
    public function setCreatedAt(?\DateTime $created_at): Review
    {
        $this->created_at = $created_at;
        return $this;
    }
}