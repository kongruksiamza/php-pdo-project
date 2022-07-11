<?php 
class Controller{
    private $db;

    function __construct($con){
        $this->db=$con;
    }

    function getDepartments(){
        try{
            $sql = "SELECT * FROM departments";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function getEmployees(){
        try{
            $sql = "SELECT * FROM employees a INNER JOIN departments b ON a.department_id = b.department_id ORDER BY a.emp_id";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function insert($fname,$lname,$salary,$department_id){
        try{
            $sql="INSERT INTO 
            employees(fname,lname,salary,department_id)
            VALUES (:fname,:lname,:salary,:department_id)
            ";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":fname",$fname);
            $stmt->bindParam(":lname",$lname);
            $stmt->bindParam(":salary",$salary);
            $stmt->bindParam(":department_id",$department_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    function delete($id){
        try{
            $sql="DELETE FROM employees WHERE emp_id=:id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function getEmployeeDetail($id){
        try{
            $sql="SELECT * FROM employees a 
            INNER JOIN departments b
            ON a.department_id = b.department_id
            WHERE emp_id = :id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function update($fname,$lname,$salary,$department_id,$emp_id){
        try{
            $sql="UPDATE employees 
            SET fname=:fname ,lname=:lname ,
            salary=:salary,department_id = :department_id 
            WHERE emp_id = :emp_id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":fname",$fname);
            $stmt->bindParam(":lname",$lname);
            $stmt->bindParam(":salary",$salary);
            $stmt->bindParam(":department_id",$department_id);
            $stmt->bindParam(":emp_id",$emp_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}


?>