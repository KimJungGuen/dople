<?php
    require_once('../model/HollerSubsidiary.php');

    /**
     * @brief   부자재 관리
     * @author  김정근
     * @date    2020-12-04
     */
    class SubsidiaryController {

        /**
         * @brief   부자재 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-04
         */
        public function register($formData, $file) {
            $model = new HollerSubsidiary();
            $file = (object)$file;
            $formData = (object)$formData;
            $result = $model->register($formData, $file);

            return $result;
        }


        public function getSubsidiary($subsidiaryNumber) {
            $model = new HollerSubsidiary();

            $result = $model->getSubsidiary($subsidiaryNumber);

            return $result;
        }


        public function update($formData, $file) {
            $model = new HollerSubsidiary();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }

        public function delete($subsidiaryNumber) {
            $model = new HollerSubsidiary();

            $result = $model->delete($subsidiaryNumber);

            return $result;
        }
    }
?>