<?php


 /**
  * Cursos Data Access Object (DAO).
  * This class contains all database handling that is needed to 
  * permanently store and retrieve Cursos object instances. 
  */

 /**
  * This sourcecode has been generated by FREE DaoGen generator version 2.4.1.
  * The usage of generated code is restricted to OpenSource software projects
  * only. DaoGen is available in http://titaniclinux.net/daogen/
  * It has been programmed by Tuomo Lukka, Tuomo.Lukka@iki.fi
  *
  * DaoGen license: The following DaoGen generated source code is licensed
  * under the terms of GNU GPL license. The full text for license is available
  * in GNU project's pages: http://www.gnu.org/copyleft/gpl.html
  *
  * If you wish to use the DaoGen generator to produce code for closed-source
  * commercial applications, you must pay the lisence fee. The price is
  * 5 USD or 5 Eur for each database table, you are generating code for.
  * (That includes unlimited amount of iterations with all supported languages
  * for each database table you are paying for.) Send mail to
  * "Tuomo.Lukka@iki.fi" for more information. Thank you!
  */



class CursosDao {


    /**
     * createValueObject-method. This method is used when the Dao class needs
     * to create new value object instance. The reason why this method exists
     * is that sometimes the programmer may want to extend also the valueObject
     * and then this method can be overrided to return extended valueObject.
     * NOTE: If you extend the valueObject class, make sure to override the
     * clone() method in it!
     */
    function createValueObject() {
          return new Cursos();
    }


    /**
     * getObject-method. This will create and load valueObject contents from database 
     * using given Primary-Key as identifier. This method is just a convenience method 
     * for the real load-method which accepts the valueObject as a parameter. Returned
     * valueObject will be created using the createValueObject() method.
     */
    function getObject($conn, $id) {

          $valueObject = $this->createValueObject();
          $valueObject->setId($id);
          $this->load($conn, $valueObject);
          return $valueObject;
    }


    /**
     * load-method. This will load valueObject contents from database using
     * Primary-Key as identifier. Upper layer should use this so that valueObject
     * instance is created and only primary-key should be specified. Then call
     * this method to complete other persistent information. This method will
     * overwrite all other fields except primary-key and possible runtime variables.
     * If load can not find matching row, NotFoundException will be thrown.
     *
     * @param conn         This method requires working database connection.
     * @param valueObject  This parameter contains the class instance to be loaded.
     *                     Primary-key field must be set for this to work properly.
     */
    function load($conn, $valueObject) {

          if (!$valueObject->getId()) {
               //print "Can not select without Primary-Key!";
               return false;
          }

          $sql = "SELECT * FROM cursos WHERE (id = ".$valueObject->getId().") "; 

          if ($this->singleQuery($conn, $sql, $valueObject))
               return true;
          else
               return false;
    }


    /**
     * LoadAll-method. This will read all contents from database table and
     * build an Vector containing valueObjects. Please note, that this method
     * will consume huge amounts of resources if table has lot's of rows. 
     * This should only be used when target tables have only small amounts
     * of data.
     *
     * @param conn         This method requires working database connection.
     */
    function loadAll($conn) {


          $sql = "SELECT * FROM cursos ORDER BY id ASC ";

          $searchResults = $this->listQuery($conn, $sql);

          return $searchResults;
    }



    /**
     * create-method. This will create new row in database according to supplied
     * valueObject contents. Make sure that values for all NOT NULL columns are
     * correctly specified. Also, if this table does not use automatic surrogate-keys
     * the primary-key must be specified. After INSERT command this method will 
     * read the generated primary-key back to valueObject if automatic surrogate-keys
     * were used. 
     *
     * @param conn         This method requires working database connection.
     * @param valueObject  This parameter contains the class instance to be created.
     *                     If automatic surrogate-keys are not used the Primary-key 
     *                     field must be set for this to work properly.
     */
    function create($conn, $valueObject) {

          $sql = "INSERT INTO cursos (  foto, descripcion, ";
          $sql = $sql."fecha_lim, horario) VALUES (";
          $sql = $sql."'".$valueObject->getFoto()."', ";
          $sql = $sql."'".$valueObject->getDescripcion()."', ";
          $sql = $sql."'".$valueObject->getFecha_lim()."', ";
          $sql = $sql."'".$valueObject->getHorario()."') ";
          $result = $this->databaseUpdate($conn, $sql);


          return true;
    }


    /**
     * save-method. This method will save the current state of valueObject to database.
     * Save can not be used to create new instances in database, so upper layer must
     * make sure that the primary-key is correctly specified. Primary-key will indicate
     * which instance is going to be updated in database. If save can not find matching 
     * row, NotFoundException will be thrown.
     *
     * @param conn         This method requires working database connection.
     * @param valueObject  This parameter contains the class instance to be saved.
     *                     Primary-key field must be set for this to work properly.
     */
    function save($conn, $valueObject) {

          $sql = "UPDATE cursos SET foto = '".$valueObject->getFoto()."', ";
          $sql = $sql."descripcion = '".$valueObject->getDescripcion()."', ";
          $sql = $sql."fecha_lim = '".$valueObject->getFecha_lim()."', ";
          $sql = $sql."horario = '".$valueObject->getHorario()."'";
          $sql = $sql." WHERE (id = ".$valueObject->getId().") ";
          $result = $this->databaseUpdate($conn, $sql);

          if ($result != 1) {
               //print "PrimaryKey Error when updating DB!";
               return false;
          }

          return true;
    }


    /**
     * delete-method. This method will remove the information from database as identified by
     * by primary-key in supplied valueObject. Once valueObject has been deleted it can not 
     * be restored by calling save. Restoring can only be done using create method but if 
     * database is using automatic surrogate-keys, the resulting object will have different 
     * primary-key than what it was in the deleted object. If delete can not find matching row,
     * NotFoundException will be thrown.
     *
     * @param conn         This method requires working database connection.
     * @param valueObject  This parameter contains the class instance to be deleted.
     *                     Primary-key field must be set for this to work properly.
     */
    function delete($conn, $valueObject) {


          if (!$valueObject->getId()) {
               //print "Can not delete without Primary-Key!";
               return false;
          }

          $sql = "DELETE FROM cursos WHERE (id = ".$valueObject->getId().") ";
          $result = $this->databaseUpdate($conn, $sql);

          if ($result != 1) {
               //print "PrimaryKey Error when updating DB!";
               return false;
          }
          return true;
    }


    /**
     * deleteAll-method. This method will remove all information from the table that matches
     * this Dao and ValueObject couple. This should be the most efficient way to clear table.
     * Once deleteAll has been called, no valueObject that has been created before can be 
     * restored by calling save. Restoring can only be done using create method but if database 
     * is using automatic surrogate-keys, the resulting object will have different primary-key 
     * than what it was in the deleted object. (Note, the implementation of this method should
     * be different with different DB backends.)
     *
     * @param conn         This method requires working database connection.
     */
    function deleteAll($conn) {

          $sql = "DELETE FROM cursos";
          $result = $this->databaseUpdate($conn, $sql);

          return true;
    }


    /**
     * coutAll-method. This method will return the number of all rows from table that matches
     * this Dao. The implementation will simply execute "select count(primarykey) from table".
     * If table is empty, the return value is 0. This method should be used before calling
     * loadAll, to make sure table has not too many rows.
     *
     * @param conn         This method requires working database connection.
     */
    function countAll($conn) {

          $sql = "SELECT count(*) FROM cursos";
          $allRows = 0;

          $result = $conn->execute($sql);

          if ($row = $conn->nextRow($result))
                $allRows = $row[0];

          return $allRows;
    }


    /** 
     * searchMatching-Method. This method provides searching capability to 
     * get matching valueObjects from database. It works by searching all 
     * objects that match permanent instance variables of given object.
     * Upper layer should use this by setting some parameters in valueObject
     * and then  call searchMatching. The result will be 0-N objects in vector, 
     * all matching those criteria you specified. Those instance-variables that
     * have NULL values are excluded in search-criteria.
     *
     * @param conn         This method requires working database connection.
     * @param valueObject  This parameter contains the class instance where search will be based.
     *                     Primary-key field should not be set.
     */
    function searchMatching($conn, $valueObject) {

          $first = true;
          $sql = "SELECT * FROM cursos WHERE 1=1 ";

          if ($valueObject->getId() != 0) {
              if ($first) { $first = false; }
              $sql = $sql."AND id = ".$valueObject->getId()." ";
          }

          if ($valueObject->getFoto() != "") {
              if ($first) { $first = false; }
              $sql = $sql."AND foto LIKE '".$valueObject->getFoto()."%' ";
          }

          if ($valueObject->getDescripcion() != "") {
              if ($first) { $first = false; }
              $sql = $sql."AND descripcion LIKE '".$valueObject->getDescripcion()."%' ";
          }

          if ($valueObject->getFecha_lim() != "") {
              if ($first) { $first = false; }
              $sql = $sql."AND fecha_lim LIKE '".$valueObject->getFecha_lim()."%' ";
          }

          if ($valueObject->getHorario() != "") {
              if ($first) { $first = false; }
              $sql = $sql."AND horario LIKE '".$valueObject->getHorario()."%' ";
          }


          $sql = $sql."ORDER BY id ASC ";

          // Prevent accidential full table results.
          // Use loadAll if all rows must be returned.
          if ($first)
               return array();

          $searchResults = $this->listQuery($conn, $sql);

          return $searchResults;
    }


    /** 
     * getDaogenVersion will return information about
     * generator which created these sources.
     */
    function getDaogenVersion() {
        return "DaoGen version 2.4.1";
    }


    /**
     * databaseUpdate-method. This method is a helper method for internal use. It will execute
     * all database handling that will change the information in tables. SELECT queries will
     * not be executed here however. The return value indicates how many rows were affected.
     * This method will also make sure that if cache is used, it will reset when data changes.
     *
     * @param conn         This method requires working database connection.
     * @param stmt         This parameter contains the SQL statement to be excuted.
     */
    function databaseUpdate($conn, $sql) {

          $result = $conn->execute($sql);

          return $result;
    }



    /**
     * databaseQuery-method. This method is a helper method for internal use. It will execute
     * all database queries that will return only one row. The resultset will be converted
     * to valueObject. If no rows were found, NotFoundException will be thrown.
     *
     * @param conn         This method requires working database connection.
     * @param stmt         This parameter contains the SQL statement to be excuted.
     * @param valueObject  Class-instance where resulting data will be stored.
     */
    function singleQuery($conn, $sql, $valueObject) {

          $result = $conn->execute($sql);

          if ($row = $conn->nextRow($result)) {

                   $valueObject->setId($row[0]); 
                   $valueObject->setFoto($row[1]); 
                   $valueObject->setDescripcion($row[2]); 
                   $valueObject->setFecha_lim($row[3]); 
                   $valueObject->setHorario($row[4]); 
          } else {
               //print " Object Not Found!";
               return false;
          }
          return true;
    }


    /**
     * databaseQuery-method. This method is a helper method for internal use. It will execute
     * all database queries that will return multiple rows. The resultset will be converted
     * to the List of valueObjects. If no rows were found, an empty List will be returned.
     *
     * @param conn         This method requires working database connection.
     * @param stmt         This parameter contains the SQL statement to be excuted.
     */
    function listQuery($conn, $sql) {

          $searchResults = array();
          $result = $conn->execute($sql);

          while ($row = $conn->nextRow($result)) {
               $temp = $this->createValueObject();

               $temp->setId($row[0]); 
               $temp->setFoto($row[1]); 
               $temp->setDescripcion($row[2]); 
               $temp->setFecha_lim($row[3]); 
               $temp->setHorario($row[4]); 
               array_push($searchResults, $temp);
          }

          return $searchResults;
    }
}

?>