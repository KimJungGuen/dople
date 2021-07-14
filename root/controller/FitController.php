<?php
    require_once('../model/HollerFit.php');

    /**
     * @brief   핏 관리
     * @author  김정근
     * @date    2020-12-03
     */
    class FitController {

        /**
         * @brief   옷종류 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-03
         */
        public function register($formData, $file) {
            $model = new HollerFit();
            $formData = (object)$formData;
            $file = (object)$file;
            $result = $model->register($formData, $file);

            return $result;
        }

        public function update($formData, $file) {
            $model = new HollerFit();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }

        public function delete($fitNumber) {
            $model = new HollerFit();

            $result = $model->delete($fitNumber);

            return $result;
        }

    }
?>