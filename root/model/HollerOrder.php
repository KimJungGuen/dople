<?php 

    /** 
     * @brief   유저 주문 관리
     * @author  김정근
     * @date    2021-01-28
     */
    class HollerOrder{
        
        /**
         * @brief   db연결 인자 생성 PDO
         * @author  김정근
         * @return  mysqli
         * @date    2021-01-28
         */
        private function connect() {
            $host = 'localhost';
            $user = 'hollerinc';
            $password = 'hollerdb01!!';
            $dbName = 'hollerinc';
            $dbChar = 'utf8';

            $dsn = "mysql:host={$host};dbname={$dbName};charset={$dbChar}";
            $pdo = new PDO($dsn, $user, $password);

            return $pdo;
        }

        /**
         * @biref   유저 샘플목록 조회
         * @author  김정근
         * @return  Array $rows
         * @date    2021-01-28
         */
        public function getsOrder() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    HA_users.user_email,
                    HA_users.user_name,
                    HA_order.order_number,
                    HA_order.order_category_number,
                    HA_order.order_model,
                    HA_order.order_status,
                    HA_order.order_produce,
                    HA_order.order_create,
                    HA_order.order_update,
                    HA_order.order_user_number
                FROM HA_users
                INNER JOIN HA_order on HA_users.user_number = HA_order.order_user_number"
            );

            if($stmt->execute()) {
                return $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   유저 샘플 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-03
         */
        public function getOrder($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    HA_users.user_email,
                    HA_users.user_name,
                    HA_order.order_sortation,
                    HA_order.order_process,
                    HA_order.order_process_type,
                    HA_order.order_number,
                    HA_order.order_material_number,
                    HA_order.order_subsidiary_number,
                    HA_order.order_sewing,
                    HA_category.category_name,
                    HA_clothes.clothes_name,
                    HA_order.order_label,   
                    HA_order.order_ml_type,    
                    HA_order.order_cl_type,
                    HA_order.order_ml_number,
                    HA_order.order_cl_number,
                    HA_order.order_kl_number,
                    HA_order.order_size_quantity,
                    HA_order.order_size_grading,
                    HA_order.order_model,
                    HA_order.order_detail_location,
                    HA_order.order_delivery,
                    HA_order.order_price,
                    HA_order.order_status,
                    HA_order.order_produce,
                    HA_order.order_pd_top,
                    HA_order.order_pd_left,
                    HA_order.order_pd_sx,
                    HA_order.order_pd_sy,
                    HA_order.order_pd_angle,
                    HA_order.order_create,
                    HA_order.order_update,
                    HA_order.order_user_number
                FROM HA_order
                INNER JOIN HA_users on HA_order.order_user_number = HA_users.user_number
                LEFT OUTER JOIN HA_category ON HA_order.order_category_number = HA_category.category_number
                LEFT OUTER JOIN HA_clothes ON HA_order.order_clothes_number = HA_clothes.clothes_number
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   유저 메인라벨 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getMainLabel($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT order_ml_img_type, order_ml_img FROM HA_order WHERE order_number = :order_number");

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   유저 케어라벨 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getCareLabel($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    order_cl_img_type,
                    order_cl_img
                FROM HA_order
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @biref   상세이미지 조회
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Array $rows
         * @date    2021-02-04
         */
        public function getPD($orderNumber, $img, $type) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "SELECT
                    {$type},
                    {$img}
                FROM HA_order
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_number', $orderNumber);

            if($stmt->execute()) {
                return $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            } else {
                return false;
            }
        }

        /**
         * @brief   유저 샘플 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2021-01-29
         */
        public function update($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_order SET
                    order_status = :order_status,
                    order_update = CURRENT_TIMESTAMP
                WHERE order_number = :order_number"
            );

            $stmt->bindValue(':order_status', $formData->state);
            $stmt->bindValue(':order_number', $formData->no);

            $pdo->beginTransaction();
            if($stmt->execute()) {
                $pdo->commit();
                return true;

            } else {
                $pdo->rollback();
                return false;
            }
        }

        /**
         * @brief   유저 샘플 삭제
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Boolean
         * @date    2021-01-29
         */
        public function delete($orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_order WHERE order_number = :order_number");

            $stmt->bindValue(":order_number", $orderNumber);

            $pdo->beginTransaction();

            if($stmt->execute()) {
                $pdo->commit();
                return true;

            } else {
                $pdo->rollback();
                return false;
            }
        }
    }

?>