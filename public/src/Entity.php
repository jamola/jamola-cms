<?php

class Entity {
    
    protected $dbc;
    protected $tableName;
    protected $fields;
    
    public function findBy($fieldName, $fieldValue){
        
        /* echo "<pre>fieldName";
        $fieldName;
        echo "</pre>";
        echo "<pre>fieldValue";
        $fieldValue;
        echo "</pre>"; */

        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $fieldName . " = :value";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value' => $fieldValue]);
        $databaseData = $stmt->fetch();
        /* echo "<pre>debugDumpParams";
        $stmt->debugDumpParams();
        echo "</pre>";
        echo "<pre>databaseData";
        var_dump($databaseData);
        echo "</pre>"; */
        
        $databaseData ? $this->setValues($databaseData) : NULL;

    }
    
    public function setValues($values) {
        
        foreach ($this->fields as $fieldName) {
            
            // TODO! Check if values is NULL!!
            $this->$fieldName = $values[$fieldName];
        }
    }
}