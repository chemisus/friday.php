<?php
class TypeController {
    public function index($MOD, $ViewFactory) {
        return $ViewFactory(array(
            'file' => array_shift(glob($MOD.'view/type.php', \GLOB_BRACE)),
            'data' => array()
        ));
    }
    
    public function install($ROOT, $file, $dbh) {
        $script = file_get_contents($ROOT.$file);
        
        echo $script;
        
        $dbh->prepare($script)->execute();
    }
    
    public function query($dbh) {
        $model = new TypeModel();
        
        return $model->query($dbh);
    }
    
    public function create($dbh, $type, $request) {
        $model = new TypeModel();
        
        return $model->create($dbh, $type, $request);
    }
    
    public function update($dbh) {
        $model = new TypeModel();
        
        return $model->update($dbh);
    }
    
    public function read($dbh, $type) {
        $model = new TypeModel();

        return $model->read($dbh, $type);
    }
    
    public function delete($dbh, $type) {
        $model = new TypeModel();
        
        return $model->delete($dbh, $type);
    }
}