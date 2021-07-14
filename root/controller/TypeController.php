<?php
    require_once('../model/HollerType.php');

    /**
     * @brief   부자재 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class TypeController {

        
        /**
         * @brief   타입 등록
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2020-12-15
         */
        public function register($formData) {
            $model = new HollerType();
            $formData = (object)$formData;

            $result = $model->register($formData);

            return $result;
        }

        /**
         * @brief   타입 수정
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2020-12-16
         */
        public function update($formData) {
            $model = new HollerType();
            $formData = (object)$formData;

            $result = $model->update($formData);

            return $result;
        }

        /**
         * @brief   타입 삭제
         * @author  김정근
         * @param   Int $typeNumber
         * @return  Boolean
         * @date    2020-12-16
         */
        public function delete($typeNumber) {
            $model = new HollerType();

            $result = $model->delete($typeNumber);

            return $result;
        }
    }
?>