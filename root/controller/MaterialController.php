<?php
    require_once('../model/HollerMaterial.php');

    /**
     * @brief   원단 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class MaterialController {

        /**
         * @brief   원단 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-04
         */
        public function register($formData, $file) {
            $model = new HollerMaterial();
            $file = (object)$file;
            $formData = (object)$formData;
            $result = $model->register($formData, $file);

            return $result;
        }


        public function getMaterial($materialNumber) {
            $model = new HollerMaterial();

            $result = $model->getMaterial($materialNumber);

            return $result;
        }


        public function update($formData, $file) {
            $model = new HollerMaterial();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }

        public function delete($materialNumber) {
            $model = new HollerMaterial();

            $result = $model->delete($materialNumber);

            return $result;
        }
    }
?>