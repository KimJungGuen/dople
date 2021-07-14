<?php
    require_once('../model/HollerClothes.php');



    /**
     * @brief   옷종류 관리
     * @author  김정근
     * @date    2020-12-03
     */
    class ClothesController {

        /**
         * @brief   옷종류 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-03
         */
        public function register($formData, $file) {
            $model = new HollerClothes();
            $formData = (object)$formData;
            $file = (object)$file;
            $result = $model->register($formData, $file);

            return $result;
        }

        public function update($formData, $file) {
            $model = new HollerClothes();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }

        public function delete($clothesNumber) {
            $model = new HollerClothes();

            $result = $model->delete($clothesNumber);

            return $result;
        }

        public function getClothes($clothesNumber) {
            $model = new HollerCategory();

            $result = $model->getClothes($clothesNumber);

            return $result;
        }

    }
?>