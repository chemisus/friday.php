<?php
class TypeModel {
    public function query($dbh) {
        try {
            $sql = "select json from type";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute();
            
            $rows = $sth->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_COLUMN, 'json');
            
            return '['.implode(',', $rows).']';
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function create($dbh, $type, $request) {
        try {
            $table = json_decode($request->input);
            
            $fields = array();
            
            foreach ($table->fields as $field) {
                $fields[] = $field->name.' '.$field->type;
            }
            
            $fields = implode(', ', $fields);
            
            $sql = "create table {$type} ({$fields}) default charset=UTF8";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array());
            
            $sql = "insert into type (name, json) values (?, ?)";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($table->name, $request->input));
            
            return json_encode($table);
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function update($dbh) {
        try {
            return 'update not implemented';
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function read($dbh, $type) {
        try {
            $sql = "select json from type where name=?";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($type));
            
            $row = $sth->fetch(\PDO::FETCH_ASSOC);
            
            return $row['json'];
        } catch (\PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function delete($dbh, $type) {
        try {
            $sql = "drop table {$type}";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute();
            
            $sql = "delete from type where name=?";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($type));
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
}