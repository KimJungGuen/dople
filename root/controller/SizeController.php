<?php
    require_once('../model/HollerSize.php');

    /**
     * @brief   사이즈 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class SizeController {

        /**
         * @brief   사이즈 등록
         * @author  김정근
         * @param   Array $formData
         * @return  Boolean
         * @date    2020-12-04
         */
        public function register($formData) {
            $model = new HollerSize();
            $formData = (object)$formData;
            $result = $model->register($formData);

            return $result;
        }


        public function getSize($sizeNumber) {
            $model = new HollerSize();

            $result = $model->getSize($sizeNumber);

            return $result;
        }


        public function update($formData) {
            $model = new HollerSize();
            $formData = (object)$formData;

            $result = $model->update($formData);

            return $result;
        }

        public function delete($sizeNumber) {
            $model = new HollerSize();

            $result = $model->delete($sizeNumber);

            return $result;
        }
    }
?>