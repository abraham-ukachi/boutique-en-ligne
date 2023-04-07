<<<<<<< HEAD
Axel
Hello
=======
<?php

namespace Api\classOrder;

use datetime;
use pdo, PDOException;

class Order
{
    private ?int $numberOfOrder = null;
    private ?int $id_user = null;
    private ?int $price = null;
    private ?DateTime $createTime = null;
    private ?DateTime $paidTime = null;
    private ?string $products = null;
    private ?string $address = null;
    private ?string $delivery = null;


    private ?object $db = null;
    private ?object $product = null;

    public function __construct($product)
    {
       $this->product = $product;

        $db_dsn = 'mysql:host=localhost; dbname=db_maxaboom';
        $username = 'root';
        str_contains($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false ? $password_db = 'root' : $password_db = '';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];

            $this->db = new PDO($db_dsn, $username, $password_db, $options);

        } catch (PDOException $e) {
            print 'Erreur! :' . $e->getMessage() . '</br>';
            die();
        }
    }

    /**
     * Method used to create and order with the given `userId` and `data`.
     *
     * @param int $id_user  - the id of the user
     * @param array $data   - a list of all the necessary data to create an order
     *
     * @return false|array - Returns TRUE if the order has been created successfully
     */
    public function createOrder(int $id_user, array $data): false|array {
        // initialize the `result` variable
        $result = ['success' => 'false', 'data' => []];

        // do nothing if there's no user id or if it is equal to -1
        if ($id_user === -1) { return 'false'; }

        /**
         * IDEA:
         *  1) - Complete the payment process w/ the payment info
         *  2) - Insert a row in the `orders` table
         *  3) - Add all the products into the `order_items` table
         */

        $created_at = date('Y-m-d h:i:s');
        $paid_at = date('Y-m-d h:i:s');;

        echo $created_at;

        try {
            // IDEA #2
//            $query = "INSERT INTO orders(`user_id`, `created_at`, `paid_at`, `total_price`) VALUES (':user_id',':created_at',':paid_at',':total_price')";
            $query = "INSERT INTO orders(`user_id`, `created_at`, `paid_at`, `total_price`) VALUES (?, ?, ?, ?)";

            /* We need to have class Database */
            $pdo_stmt = $this->db->prepare($query);
            // bind the params
//            $pdo_stmt->bindParam(':user_id', $id_user);
//            $pdo_stmt->bindParam(':created_at', $created_at);
//            $pdo_stmt->bindParam(':paid_at', $paid_at);
//            $pdo_stmt->bindParam(':total_price', $total_price);

            // execute the pdo statement
            $pdo_stmt->execute(Array($id_user, $created_at, $paid_at, $data['totalPrice']));

            $rowCount = $pdo_stmt->rowCount();

            echo "Row Count =>>>> $rowCount" . "<br>";



            $result['success'] = 'true';

            // get the order id
            $randomOrderId = $this->generateOrderId();

            // TODO: IDEA #3

            echo $randomOrderId;

            $result['data'] = ['randomOrderId' => $randomOrderId, 'userId' => $id_user];



            //        foreach ($data['products'] as $productId => $productQty) {
            //            // get the product detail using the `productId`
            //            $products[] = $this->product->getProductById($productId);
            //
            //            }

        } catch (PDOException $e) {
            // handle the pdo exception
            echo $e->getMessage();
            die();

        }



        return $result;

    }


    /**
     * Generates a time-based random order id.
     *
     * @return int
     */
    private function generateOrderId(): int {
        // get current timestamp
        $timestamp = time();
        // convert timestamp from binary to hexadecimal value & stringify the number
        $hexTimestamp = strval(bin2hex($timestamp));

        // IDEA: Use the last 9 numbers from `hexTimestamp` as the randomly generated order id
        return (int) substr($hexTimestamp, -9, 9);

    }

    /* Getters and setters of my properties */

    /**
     * @return int|null
     */
    public function getNumberOfOrder(): ?int
    {
        return $this->numberOfOrder;
    }

    /**
     * @param int|null $numberOfOrder
     * @return Product
     */
    public function setNumberOfOrder(?int $numberOfOrder): Product
    {
        $this->numberOfOrder = $numberOfOrder;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    /**
     * @param int|null $id_user
     * @return Product
     */
    public function setIdUser(?int $id_user): Product
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     * @return Product
     */
    public function setPrice(?int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreateTime(): ?DateTime
    {
        return $this->createTime;
    }

    /**
     * @param DateTime|null $createTime
     * @return Product
     */
    public function setCreateTime(?DateTime $createTime): Product
    {
        $this->createTime = $createTime;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPaidTime(): ?DateTime
    {
        return $this->paidTime;
    }

    /**
     * @param DateTime|null $paidTime
     * @return Product
     */
    public function setPaidTime(?DateTime $paidTime): Product
    {
        $this->paidTime = $paidTime;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProduct(): ?string
    {
        return $this->product;
    }

    /**
     * @param string|null $product
     * @return Product
     */
    public function setProduct(?string $product): Product
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return Product
     */
    public function setAddress(?string $address): Product
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDelivery(): ?string
    {
        return $this->delivery;
    }

    /**
     * @param string|null $delivery
     * @return Product
     */
    public function setDelivery(?string $delivery): Product
    {
        $this->delivery = $delivery;
        return $this;
    }
}

>>>>>>> ae57ad7 (add method createOrder, generateOrderId on class Order and getProductById on class Product)
