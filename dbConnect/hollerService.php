<?php
    /**
     * @biref   고객센터 공지사항
     * @author  김정근
     * @date    2021-01-12
     */
    class hollerService{

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
         * @biref   공지사항 등록
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2020-01-11
         */
        public function noticeRegiste($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "INSERT HA_notice(
                    notice_title,
                    notice_text,
                    notice_create
                ) VALUES (
                    :notice_title,
                    :notice_text,
                    CURRENT_TIMESTAMP
                )"
            );
            
            $stmt->bindValue(':notice_title', $formData->title);
            $stmt->bindValue(':notice_text', $formData->notice);
            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        /**
         * @biref   공지사항 수정
         * @author  김정근
         * @param   Object $formData
         * @return  Boolean
         * @date    2021-01-11
         */
        public function noticeUpdate($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_notice SET
                    notice_title = :notice_title,
                    notice_text = :notice_text,
                    notice_update = CURRENT_TIMESTAMP
                WHERE notice_number = :notice_number"
            );

            $stmt->bindValue(':notice_title', $formData->title);
            $stmt->bindValue(':notice_text', $formData->notice);
            $stmt->bindValue(':notice_number', $formData->no);
            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function noticeDelete($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_notice WHERE notice_number = :notice_number");

            $stmt->bindValue(':notice_number', $formData->no);
            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function totalNotice(){
            $pdo = $this->connect();

            $stmt = $pdo->prepare("SELECT count(*) FROM HA_notice");

            $check = $stmt->execute();

            if($check) {
                $rowCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rowCount;
            } else {
                return 0;
            }
        }

        public function getsNotice($pageStart, $pageEnd) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT notice_number, notice_title, notice_create FROM HA_notice ORDER BY notice_number DESC LIMIT :pageStart, :pageEnd ");
            
            $stmt->bindValue(':pageStart', $pageStart, PDO::PARAM_INT);
            $stmt->bindValue(':pageEnd', $pageEnd, PDO::PARAM_INT);
            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function getNotice($noticeNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_notice WHERE notice_number = :notice_number");
            
            $stmt->bindValue(':notice_number', $noticeNumber, PDO::PARAM_INT);
            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }   

        public function faqRegiste($formData) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(
                "INSERT HA_faq(
                    faq_title,
                    faq_text,
                    faq_create
                ) VALUES (
                    :faq_title,
                    :faq_text,
                    CURRENT_TIMESTAMP
                )"
            );

            $stmt->bindValue(':faq_title', $formData->title);
            $stmt->bindValue(':faq_text', $formData->faq);
            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function faqUpdate($formData) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(
                "UPDATE HA_faq SET
                    faq_title = :faq_title,
                    faq_text = :faq_text,
                    faq_update = CURRENT_TIMESTAMP
                WHERE faq_number = :faq_number"
            );

            $stmt->bindValue(':faq_title', $formData->title);
            $stmt->bindValue(':faq_text', $formData->faq);
            $stmt->bindValue(':faq_number', $formData->no);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function faqDelete($formData) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare("DELETE FROM HA_faq WHERE faq_number = :faq_number");

            $stmt->bindValue(':faq_number', $formData->no);
            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function getsFaq() {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_faq");
            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function getFaq($faqNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_faq WHERE faq_number = :faq_number");
            $stmt->bindValue(':faq_number', $faqNumber);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function searchFaq($searchTitle) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT * FROM HA_faq WHERE faq_title LIKE :faq_title");
            $stmt->bindValue(':faq_title', "%{$searchTitle}%");

            if($stmt->execute()) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $rows;
            } else {
                return false;
            }
        }

        public function inquiryRegiste($formData, $fileInfo, $fileType) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(
                "INSERT HA_inquiry(
                    inquiry_title,
                    inquiry_question,
                    inquiry_user_number,
                    inquiry_create,
                    inquiry_img_type_1,
                    inquiry_img_1,
                    inquiry_img_type_2,
                    inquiry_img_2,
                    inquiry_img_type_3,
                    inquiry_img_3,
                    inquiry_img_type_4,
                    inquiry_img_4,
                    inquiry_img_type_5,
                    inquiry_img_5
                ) VALUES (
                    :inquiry_title,
                    :inquiry_question,
                    :inquiry_user_number,
                    CURRENT_TIMESTAMP,
                    :inquiry_img_type_1,
                    :inquiry_img_1,
                    :inquiry_img_type_2,
                    :inquiry_img_2,
                    :inquiry_img_type_3,
                    :inquiry_img_3,
                    :inquiry_img_type_4,
                    :inquiry_img_4,
                    :inquiry_img_type_5,
                    :inquiry_img_5
                )"
            );

            $stmt->bindValue(':inquiry_title', $formData->title);
            $stmt->bindValue(':inquiry_question', $formData->inquiry);
            $stmt->bindValue(':inquiry_user_number', $formData->userNumber);
            $stmt->bindValue(':inquiry_img_type_1', $fileType['image_1']);
            $stmt->bindValue(':inquiry_img_1', $fileInfo['image_1'], PDO::PARAM_LOB);
            $stmt->bindValue(':inquiry_img_type_2', $fileType['image_2']);
            $stmt->bindValue(':inquiry_img_2', $fileInfo['image_2'], PDO::PARAM_LOB);
            $stmt->bindValue(':inquiry_img_type_3', $fileType['image_3']);
            $stmt->bindValue(':inquiry_img_3', $fileInfo['image_3'], PDO::PARAM_LOB);
            $stmt->bindValue(':inquiry_img_type_4', $fileType['image_4']);
            $stmt->bindValue(':inquiry_img_4', $fileInfo['image_4'], PDO::PARAM_LOB);
            $stmt->bindValue(':inquiry_img_type_5', $fileType['image_5']);
            $stmt->bindValue(':inquiry_img_5', $fileInfo['image_5'], PDO::PARAM_LOB);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        public function getsInquiry($userNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT inquiry_title, inquiry_create, inquiry_update, inquiry_number
                FROM HA_inquiry WHERE inquiry_user_number = :inquiry_user_number");
            $stmt->bindValue(':inquiry_user_number', $userNumber);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function getsAllInquiry() {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT inquiry_title, inquiry_create, inquiry_update, inquiry_number FROM HA_inquiry");

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function getInquiry($inquiryNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT inquiry_number, inquiry_title, inquiry_create, inquiry_update, inquiry_number, inquiry_question, inquiry_answer
                FROM HA_inquiry WHERE inquiry_number = :inquiry_number");
            $stmt->bindValue(':inquiry_number', $inquiryNumber);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function getInquiryImg($inquiryNumber, $imageNumber) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare("SELECT inquiry_img_type_{$imageNumber}, inquiry_img_{$imageNumber}
                FROM HA_inquiry WHERE inquiry_number = :inquiry_number");
            $stmt->bindValue(':inquiry_number', $inquiryNumber);

            $check = $stmt->execute();

            if($check) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return null;
            }
        }

        public function inquiryUpdate($formData) {
            $pdo = $this->connect();
            $stmt = $pdo->prepare(
                "UPDATE HA_inquiry SET
                    inquiry_answer = :inquiry_answer,
                    inquiry_update = CURRENT_TIMESTAMP
                WHERE inquiry_number = :inquiry_number"
            );

            $stmt->bindValue(':inquiry_answer', $formData->answer);
            $stmt->bindValue(':inquiry_number', $formData->no);

            $pdo->beginTransaction();
            $check = $stmt->execute();

            if($check) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }
    }
?>