<?php

    /**
     * @brief   결제관련 db처리
     * @author  김정근
     * @date    2021-04-30
     */
    class hollerPayment {

        /**
         * @brief   db연결 인자 생성
         * @author  김정근
         * @return  mysqli
         * @date    2020-11-16
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
         * @brief   결제 저장 
         * @author  김정근
         * @param   Array  $data
         * @return  String 
         * @date    2021-04-30
         */
        public function insert($data) {
            $pdo = $this->connect();
            $pdoPayKind = $this->connect();

            $kindNumber = 0;

            foreach($data as $key => $value) {
                $data[$key] = iconv("EUC-KR", "UTF-8", $value); 
            }
            
            switch($data['payKind']) {
                //신용카드
                case "100000000000":
                    $stmtPayKind = $pdoPayKind->prepare(
                        "INSERT HA_pay_card(
                            card_cd,
                            card_name,
                            card_app_time,
                            card_app_no,
                            card_noinf,
                            card_quota,
                            card_partcanc,
                            card_type_1,
                            card_type_2,
                            card_mny,
                            card_pnt_amount,
                            card_pnt_time,
                            card_pnt_no,
                            card_pnt_add,
                            card_pnt_use,
                            card_pnt_rsv,
                            card_date
                        ) VALUES (
                            :card_cd,
                            :card_name,
                            :card_app_time,
                            :card_app_no,
                            :card_noinf,
                            :card_quota,
                            :card_partcanc,
                            :card_type_1,
                            :card_type_2,
                            :card_mny,
                            :card_pnt_amount,
                            :card_pnt_time,
                            :card_pnt_no,
                            :card_pnt_add,
                            :card_pnt_use,
                            :card_pnt_rsv,
                            CURRENT_TIMESTAMP
                        )"
                    ); 

                    $stmtPayKind->bindValue('card_cd', $data['cardCd']);
                    $stmtPayKind->bindValue('card_name', $data['cardName']);
                    $stmtPayKind->bindValue('card_app_time', $data['appTime']);
                    $stmtPayKind->bindValue('card_app_no', $data['appNo']);
                    $stmtPayKind->bindValue('card_noinf', $data['noinf']);
                    $stmtPayKind->bindValue('card_quota', $data['quota']);
                    $stmtPayKind->bindValue('card_partcanc', $data['partcanc']);
                    $stmtPayKind->bindValue('card_type_1', $data['cardType1']);
                    $stmtPayKind->bindValue('card_type_2', $data['cardType2']);
                    $stmtPayKind->bindValue('card_mny', $data['cardMny']);
                    $stmtPayKind->bindValue('card_pnt_amount', $data['pntAmount']);
                    $stmtPayKind->bindValue('card_pnt_time', $data['pntAppTime']);
                    $stmtPayKind->bindValue('card_pnt_no', $data['pntAppNo']);
                    $stmtPayKind->bindValue('card_pnt_add', $data['pntAdd']);
                    $stmtPayKind->bindValue('card_pnt_use', $data['pntUse']);
                    $stmtPayKind->bindValue('card_pnt_rsv', $data['pntRsv']);

                    $pdoPayKind->beginTransaction();

                    if($stmtPayKind->execute()) {
                        $kindNumber = $pdoPayKind->lastInsertId();
                        $pdoPayKind->commit();
                    } else {
                        $pdoPayKind->rollback();
                    }
                    break;
                //계좌이체
                case "010000000000":
                    $stmtPayKind = $pdoPayKind->prepare(
                        "INSERT HA_pay_account(
                            account_name,
                            account_app_time,
                            account_code,
                            account_mny,
                            account_date
                        ) VALUES (
                            :account_name,
                            :account_app_time,
                            :account_code,
                            :account_mny,
                            CURRENT_TIMESTAMP
                        )"
                    );

                    $stmtPayKind->bindValue('account_name', $data['bankName']);
                    $stmtPayKind->bindValue('account_app_time', $data['appTime']);
                    $stmtPayKind->bindValue('account_code', $data['bankCode']);
                    $stmtPayKind->bindValue('account_mny', $data['bankMny']);

                    $pdoPayKind->beginTransaction();

                    if($stmtPayKind->execute()) {
                        $kindNumber = $pdoPayKind->lastInsertId();
                        $pdoPayKind->commit();
                    } else {
                        $pdoPayKind->rollback();
                    }
                    break;
                //가상계좌
                case "001000000000":
                    $stmtPayKind = $pdoPayKind->prepare( 
                        "INSERT HA_pay_cms(
                            cms_name,
                            cms_depositor,
                            cms_account,
                            cms_va_date,
                            cms_date,
                            cms_deposit
                        ) VALUES (
                            :cms_name,
                            :cms_depositor,
                            :cms_account,
                            :cms_va_date, 
                            CURRENT_TIMESTAMP,
                            :cms_deposit
                        )"
                    );

                    $stmtPayKind->bindValue('cms_name', $data['bankName']);
                    $stmtPayKind->bindValue('cms_depositor', $data['depositor']);
                    $stmtPayKind->bindValue('cms_account', $data['account']);
                    $stmtPayKind->bindValue('cms_va_date', $data['vaDate']);
                    $stmtPayKind->bindValue('cms_deposit', "N");

                    $pdoPayKind->beginTransaction();

                    if($stmtPayKind->execute()) {
                        $kindNumber = $pdoPayKind->lastInsertId();
                        $pdoPayKind->commit();
                    } else {
                        $pdoPayKind->rollback();
                    }
                    break;
                default:
                    return "false";
                    break;
            }

            if($kindNumber != 0) {  
                $stmt = $pdo->prepare(
                    "INSERT HA_payment(
                        payment_cus_ip,
                        payment_tno,
                        payment_amount,
                        payment_good_code,
                        payment_kind,
                        payment_kind_number,
                        payment_date,
                        payment_user_number,
                        payment_order_number
                    ) VALUES (
                        :payment_cus_ip,
                        :payment_tno,
                        :payment_amount,
                        :payment_good_code,
                        :payment_kind,
                        :payment_kind_number,
                        CURRENT_TIMESTAMP,
                        :payment_user_number,
                        :payment_order_number
                    )"
                );

                $stmt->bindValue('payment_cus_ip', $data['ip']);
                $stmt->bindValue('payment_tno', $data['tno']);
                $stmt->bindValue('payment_amount', $data['amount']);
                $stmt->bindValue('payment_good_code', $data['goodCode']);
                $stmt->bindValue('payment_kind', $data['payKind']);
                $stmt->bindValue('payment_kind_number', $kindNumber);
                $stmt->bindValue('payment_user_number', $data['userNumber']);
                $stmt->bindValue('payment_order_number', $data['orderNumber'], PDO::PARAM_INT);

                $pdo->beginTransaction();

                if($stmt->execute()) {
                    $pdo->commit();
                    return "";
                } else {
                    $pdo->rollback();
                    return "false";
                }
            }
        }

        /**
         * @brief   공통정보 처리
         * @author  김정근
         * @param   Array $data
         * @return  Boolean
         * @date    2021-05-10
         */
        public function cmsResultInsert($data) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare( 
                "INSERT HA_pay_cms_result(
                    pcr_site_cd,
                    pcr_tno,
                    pcr_order_no,
                    pcr_tx_cd,
                    pcr_tx_tm,
                    pcr_name,
                    pcr_remitter,
                    pcr_mnyx,
                    pcr_bank_code,
                    pcr_account,
                    pcr_op_cd,
                    pcr_noti_id,
                    pcr_cash_a_no,
                    pcr_cash_a_dt,
                    pcr_cash_no
                ) VALUES (
                    :pcr_site_cd,
                    :pcr_tno,
                    :pcr_order_no,
                    :pcr_tx_cd,
                    :pcr_tx_tm,
                    :pcr_name, 
                    :pcr_remitter,
                    :pcr_mnyx,
                    :pcr_bank_code,
                    :pcr_account,
                    :pcr_op_cd,
                    :pcr_noti_id,
                    :pcr_cash_a_no,
                    :pcr_cash_a_dt,
                    :pcr_cash_no
                )" 
            ); 

            $stmt->bindValue('pcr_site_cd', $data['site_cd']);
            $stmt->bindValue('pcr_tno', $data['tno']);
            $stmt->bindValue('pcr_order_no', $data['order_no']);
            $stmt->bindValue('pcr_tx_cd', $data['tx_cd']);
            $stmt->bindValue('pcr_tx_tm', $data['tx_tm']);
            $stmt->bindValue('pcr_name', $data['ipgm_name']);
            $stmt->bindValue('pcr_remitter', $data['remitter']);
            $stmt->bindValue('pcr_mnyx', $data['ipgm_mnyx']);
            $stmt->bindValue('pcr_bank_code', $data['bank_code']);
            $stmt->bindValue('pcr_account', $data['account']);
            $stmt->bindValue('pcr_op_cd', $data['op_cd']);
            $stmt->bindValue('pcr_noti_id', $data['noti_id']);
            $stmt->bindValue('pcr_cash_a_no', $data['cash_a_no']);
            $stmt->bindValue('pcr_cash_a_dt', $data['cash_a_dt']);
            $stmt->bindValue('pcr_cash_no', $data['cash_no']);

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
         * @brief   결제처리에 의한 가상계좌 입금상태변경
         * @author  김정근
         * @param   String $tno
         * @return  Boolean
         * @date    2021-05-12
         */
        public function cmsUpdate($tno) {
            $pdo = $this->connect();

            $tno = iconv("EUC-KR", "UTF-8", $tno); 

            $stmt = $pdo->prepare(
                "UPDATE HA_pay_cms SET
                    HA_pay_cms.cms_deposit = :cms_deposit
                WHERE
                    HA_pay_cms.cms_number = (
                        SELECT HA_payment.payment_kind_number 
                        FROM HA_payment
                        WHERE HA_payment.payment_tno = :payment_tno
                    )"
            );

            $stmt->bindValue('cms_deposit', "Y");
            $stmt->bindValue('payment_tno', $tno);

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
         * @brief   주문 결제일 수정
         * @author  김정근
         * @param   Int $userNumber
         * @return  Boolean
         * @date    2021-05-24
         */
        public function orderBuyDate($userNumber, $orderNumber) {
            $pdo = $this->connect();

            $stmt = $pdo->prepare(
                "UPDATE HA_order SET
                    order_buy = CURRENT_TIMESTAMP,
                    order_status = :order_status
                WHERE
                    order_user_number = :order_user_number
                AND
                    order_number = :order_number"
            );

            $stmt->bindValue('order_status', "제작대기중");
            $stmt->bindValue('order_user_number', $userNumber);
            $stmt->bindValue('order_number', $orderNumber);

            $pdo->beginTransaction();

            if($stmt->execute()) {
                $pdo->commit();
                return true;
            } else {
                $pdo->rollback();
                return false;
            }
        }

        //test용
        public function cmsTest($tno) {
            $pdo = $this->connect();

            $tno = iconv("EUC-KR", "UTF-8", $tno); 

            $stmt = $pdo->prepare(
                "SELECT * FROM HA_pay_cms WHERE
                HA_pay_cms.cms_number = (SELECT HA_payment.payment_kind_number 
                FROM HA_payment
                WHERE HA_payment.payment_tno = :payment_tno)"
            );

            $stmt->bindValue('payment_tno', $tno);

            if($stmt->execute()) {
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $row;
            } else {
                return false;
            }
        }
    }

?>