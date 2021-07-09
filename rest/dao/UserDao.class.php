<?php
require_once 'BaseDao.class.php';

class UserDao extends BaseDao{

  public $table = 'users';

  public function __construct(){
    parent::__construct($this->table);
  }

  public function get_user_by_email($email){
    $query = "SELECT * FROM users WHERE email=:email";
    return @($this->execute_query($query, ['email' => $email]))[0];
  }

  public function get_user_by_id($id){
    $query = "SELECT * FROM users WHERE id=:id";
    return @($this->execute_query($query, ['id' => $id]))[0];
  }

  public function get_workers(){
    $query = "SELECT * FROM users WHERE job != '-'";
    return $this->execute_query($query, []);
  }

  public function delete_user($id){
    $query = "DELETE FROM users WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function get_non_workers(){
    $query = "SELECT * FROM users WHERE job LIKE '-'";
    return $this->execute_query($query, []);
  }

  public function delete_non_worker($id){
    $query = "DELETE * FROM users WHERE id =:id";
    return $this->execute_query1($query, ['id' => $id]);
  }

  public function update_user($user, $user_id){
    $entity[':id'] = $user_id;
    $query= 'UPDATE '.  $this->table . ' SET ';
    foreach ($user as $key => $value) {
      $query .= $key . '=:' . $key . ', ';
      $entity[':' . $key] = $value;
    }
    $query = rtrim($query,', ') . ' WHERE id=:id';
    return $this->update($entity, $query);
  }


}
?>
