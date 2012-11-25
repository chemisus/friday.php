<?php
class ObjectModel {
    public function query($dbh, $type) {
        try {
            $sql = "select o.json from object o inner join `{$type}` t on t.id = o.id where o.type=?";
        
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($type));
            
            $rows = $sth->fetchAll(\PDO::FETCH_ASSOC|\PDO::FETCH_COLUMN, 'json');

            return '['.implode(',', $rows).']';
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function create($dbh, $request, $type) {
        try {
            $input = $request->input;
            
            $sql = "select json from type where name=?";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($type));
            
            $structure = json_decode($sth->fetchColumn());
            
            $sql = "insert into object (id, type, json) values (?, ?, ?)";

            $object = json_decode($input);

            $id = md5(uniqid());

            $object->id = $id;

            $json = json_encode($object);

            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($id, $type, $json));
            
            $placeholders = array();
            
            $parameters = array();
            
            foreach ($structure->fields as $field) {
                $key = $field->name;
                
                if (isset($object->{$key})) {
                    $placeholders[$key] = $object->{$key};
                    
                    $parameters[":{$key}"] = $object->{$key};
                }
            }
            
            $keys = implode(',', array_keys($placeholders));
            
            $values = implode(',', array_keys($parameters));

            $sql = "insert into `{$type}` ({$keys}) values ({$values})";

            $sth = $dbh->prepare($sql);
            
            $sth->execute($parameters);

            return $json;
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function update($type, $id, $dbh, $request) {
        try {
            $input = $request->input;
            
            $sql = "select json from type where name=?";
            
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($type));
            
            $structure = json_decode($sth->fetchColumn());

            $object = json_decode($input);

            $json = json_encode($object);

            $sql = "update object set json=? where id=? && type=?";

            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($json, $id, $type));

            $placeholders = array();
            
            $parameters = array();
            
            foreach ($structure->fields as $field) {
                $key = $field->name;
                
                if (isset($object->{$key})) {
                    $placeholders[$key] = $object->{$key};
                    
                    $parameters[":{$key}"] = $object->{$key};
                }
            }

            $sets = array_map(function ($value, $key) {
                return "{$key} = {$value}";
            }, array_keys($parameters), array_keys($placeholders));

            $sets = implode(', ', $sets);

            $sets = empty($sets) ? '' : "set {$sets}";
            
            $sql = "update `{$type}` {$sets} where id='{$id}'";

            $sth = $dbh->prepare($sql);

            $sth->execute($parameters);

            return $json;
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function read($dbh, $type, $id) {
        try {
            $sql = "select * from object where id=? && type=?";

            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($id, $type));

            $object = $sth->fetch();
            
            return $object['json'];
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
    
    public function delete($dbh, $type, $id) {
        try {
            $sql = "delete from object where id=? && type=?";

            $sth = $dbh->prepare($sql);
            
            $sth->execute(array($id, $type));
        } catch (PDOException $e) {
            return 'Database Error: ' . $e->getMessage();
        }
    }
}