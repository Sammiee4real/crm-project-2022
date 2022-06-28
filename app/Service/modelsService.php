<?php
    namespace App\Service;
    // use App\Services\ModelsService;

    class modelsService {
        public function getIDFromTitle($titleField,$titleValue,$modelClass)
        {
            return $modelClass::where($titleField,$titleValue)->first()->id;
        }
    }
?>