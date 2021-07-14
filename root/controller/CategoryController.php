<?php
    require_once('../model/HollerCategory.php');

    /**
     * @brief   카테고리 관리
     * @author  김정근
     * @date    2020-12-01
     */
    class CategoryController {

        /**
         * @brief   카테고리 등록
         * @author  김정근
         * @param   String $categoryName
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-01
         */
        public function register($categoryName, $file) {
            $model = new HollerCategory();
            $file = (object)$file;
            $result = $model->register($categoryName, $file);
            
            return $result;
        }


        /**
         * @brief   카테고리 목록 조회
         * @author  김정근
         * @return  Array $result
         * @date    2021-07-14
         */
        public function getsCategory() {
            $model = new HollerCategory();
            $result = $model->getsCategory();

            return $result;
        }

        /**
         * @brief   카테고리 조회
         * @author  김정근
         * @param   Int $categoryNumber
         * @return  Array $result
         * @date    2020-12-01
         */
        public function getCategory($categoryNumber) {
            $model = new HollerCategory();

            $result = $model->getCategory($categoryNumber);

            return $result;
        }

        /**
         * @brief   카테고리 수정
         * @author  김정근
         * @param   Array $formData
         * @param   Array $file
         * @return  Boolean
         * @date    2020-12-01
         */
        public function update($formData, $file) {
            $model = new HollerCategory();
            $formData = (object)$formData;
            $file = (object)$file;

            $result = $model->update($formData, $file);

            return $result;
        }


        /**
         * @brief   카테고리 삭제
         * @author  김정근
         * @param   Int $categoryNumber
         * @return  Boolean
         * @date    2020-12-01
         */
        public function delete($categoryNumber) {
            $model = new HollerCategory();

            $result = $model->delete($categoryNumber);

            return $result;
        }
    }
?>