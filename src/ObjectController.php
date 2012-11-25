<?php
class ObjectController {
    public function index() {
    }
    
    public function query($dbh, $type) {
        $model = new ObjectModel();
        
        return $model->query($dbh, $type);
    }
    
    public function create($dbh, $request, $type) {
        $model = new ObjectModel();
        
        return $model->create($dbh, $request, $type);
    }
    
    public function update($type, $id, $dbh, $request) {
        $model = new ObjectModel();
        
        return $model->update($type, $id, $dbh, $request);
    }
    
    public function read($dbh, $type, $id) {
        $model = new ObjectModel();
        
        return $model->read($dbh, $type, $id);
    }
    
    public function delete($dbh, $type, $id) {
        $model = new ObjectModel();
        
        return $model->delete($dbh, $type, $id);
    }
}