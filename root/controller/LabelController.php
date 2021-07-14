<?php
    require_once('../model/HollerLabel.php');

    /**
     * @brief   라벨 관리
     * @author  김정근
     * @date    2021-03-08
     */
    class LabelController {

        /**
         * @brief   라벨 등록
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2021-03-08
         */
        public function register($formData, $file) {
            $model = new HollerLabel();
            $formData = (object)$formData;
            $file = (object)$file;
            $result = $model->register($formData, $file);

            return $result;
        }


        // public function getLabel($categoryNumber) {
        //     $model = new HollerLabel();

        //     $result = $model->getLabel($categoryNumber);

        //     return $result;
        // }

        
        /**
         * @brief   라벨 수정
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2021-03-09
         */
        public function update($formData, $file) {
            $model = new HollerLabel();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }


        /**
         * @brief   라벨 삭제
         * @author  김정근
         * @param   Int $labelNumber
         * @return  Boolean
         * @date    2021-03-09
         */
        public function delete($labelNumber) {
            $model = new HollerLabel();

            $result = $model->delete($labelNumber);

            return $result;
        }
    }
?>