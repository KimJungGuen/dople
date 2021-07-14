<?php
    require_once('../model/HollerOrder.php');

    /**
     * @brief   유저 샘플 관리
     * @author  김정근
     * @date    2021-01-29
     */
    class OrderController {

        /**
         * @brief   유저 샘플 수정
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2021-01-29
         */
        public function update($formData) {
            $model = new HollerOrder();
            $formData = (object)$formData;

            $result = $model->update($formData);
            return $result;
        }

        /**
         * @brief   유저 샘플 삭제
         * @author  김정근
         * @param   Int $orderNumber
         * @return  Boolean
         * @date    2021-01-29
         */
        public function delete($orderNumber) {
            $model = new HollerOrder();

            $result = $model->delete($orderNumber);
            return $result;
        }
    }
?>