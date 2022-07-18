<?php
namespace App\Service;

class ModelsService {
    public function getIDFromTitle($titleField,$titleValue,$modelClass)
    {
        return $modelClass::where($titleField,$titleValue)->first()->id;
    }
}
?>