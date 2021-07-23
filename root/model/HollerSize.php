<?php
    /**
     * @brief   사이즈관리
     * @author  김정근
     * @date    2020-12-10
     */
    class HollerSize{
        /**
         * @brief   db연결 인자 생성 PDO
         * @author  김정근
         * @return  mysqli
         * @date    2020-11-24
         */
        private function connect() {
            $host = '';
            $user = '';
            $password = '';
            $dbName = '';
            $dbChar = '';

            $dsn = "mysql:host={$host};dbname={$dbName};charset={$dbChar}";
            $pdo = new PDO($dsn, $user, $password);

            return $pdo;
        }

        /**
         * @brief   핏 목록
         * @author  김정근
         * @return  Array $rows
         * @date    2020-12-10
         */
        public function getsSize() {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT * FROM HA_size");
            $check = $stmt->execute();

            if($check) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        }


        /**
         * @brief   사이즈 등록
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-12-10
         */
        public function register($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("INSERT HA_size(
                    size_shoulder_width,
                    size_chest,
                    size_bottom_width,
                    size_total_length,
                    size_neck_hole,
                    size_arm_hole,
                    size_sleeve_length,
                    size_sleeve_width,
                    size_shibori,
                    size_neck_depth,
                    size_fit_number,
                    size_create
                )
                VALUES(
                        :size_shoulder_width,
                        :size_chest,
                        :size_bottom_width,
                        :size_total_length,
                        :size_neck_hole,
                        :size_arm_hole,
                        :size_sleeve_length,
                        :size_sleeve_width,
                        :size_shibori,
                        :size_neck_depth,
                        :size_fit_number,
                        CURRENT_TIMESTAMP
                    )");

            $stmt->bindValue(':size_shoulder_width', $formData->shoulder_width);
            $stmt->bindValue(':size_chest', $formData->chest);
            $stmt->bindValue(':size_bottom_width', $formData->bottom_width);
            $stmt->bindValue(':size_total_length', $formData->total_length);
            $stmt->bindValue(':size_neck_hole', $formData->neck_hole);
            $stmt->bindValue(':size_arm_hole', $formData->arm_hole);
            $stmt->bindValue(':size_sleeve_length', $formData->sleeve_length);
            $stmt->bindValue(':size_sleeve_width', $formData->sleeve_width);
            $stmt->bindValue(':size_shibori', $formData->shibori);
            $stmt->bindValue(':size_neck_depth', $formData->neck_depth);
            $stmt->bindValue(':size_fit_number', $formData->fit);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                fclose($fileInfo);
                return false;
            }
        }


        /**
         * @brief   사이즈 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-12-10
         */
        public function update($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("UPDATE HA_size SET
                    size_shoulder_width = :size_shoulder_width,
                    size_chest = :size_chest,
                    size_bottom_width = :size_bottom_width,
                    size_total_length = :size_total_length,
                    size_neck_hole = :size_neck_hole,
                    size_arm_hole = :size_arm_hole,
                    size_sleeve_length = :size_sleeve_length,
                    size_sleeve_width = :size_sleeve_width,
                    size_shibori = :size_shibori,
                    size_neck_depth = :size_neck_depth,
                    size_fit_number = :size_fit_number,
                    size_update = CURRENT_TIMESTAMP
                    WHERE size_number = :size_number"
                );
            
            $stmt->bindValue(':size_number', $formData->no);
            $stmt->bindValue(':size_shoulder_width', $formData->shoulder_width);
            $stmt->bindValue(':size_chest', $formData->chest);
            $stmt->bindValue(':size_bottom_width', $formData->bottom_width);
            $stmt->bindValue(':size_total_length', $formData->total_length);
            $stmt->bindValue(':size_neck_hole', $formData->neck_hole);
            $stmt->bindValue(':size_arm_hole', $formData->arm_hole);
            $stmt->bindValue(':size_sleeve_length', $formData->sleeve_length);
            $stmt->bindValue(':size_sleeve_width', $formData->sleeve_width);
            $stmt->bindValue(':size_shibori', $formData->shibori);
            $stmt->bindValue(':size_neck_depth', $formData->neck_depth);
            $stmt->bindValue(':size_fit_number', $formData->fit);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                fclose($fileInfo);
                return false;
            }
        }
    }


?>