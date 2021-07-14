<?php
    require_once('../model/HollerClothesDetail.php');

    /**
     * @brief   옷종류 상세 관리
     * @author  김정근
     * @date    2020-12-08
     */
    class ClothesDetailController {

        /**
         * @brief   옷종류 상세 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-08
         */
        public function register($formData, $file) {
            $model = new HollerClothesDetail();
            $formData = (object)$formData;
            $file = (object)$file;
            $result = $model->register($formData, $file);

            return $result;
        }

        public function update($formData, $file) {
            $model = new HollerClothesDetail();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }

        public function delete($clothesDetailNumber) {
            $model = new HollerClothesDetail();

            $result = $model->delete($clothesDetailNumber);

            return $result;
        }

    }
?>