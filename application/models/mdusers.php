<?php

include PATH . '/application/ext/entity/DBUsers.php';

class MDUsers extends BaseModel {

    private $_db;

    public function __construct() {
        $this->_db = new Database();
    }

    /**
     * Retrieve user by email and password
     *
     * @param string $email - user email
     * @param string $password - user password
     * @return DBUsers|null
     */
    public function getUserForAuthorization($email, $password) {
        $db = $this->_db->connect_to_db();
        $data = $db->query("SELECT * FROM ".DBUsers::getTableName()." WHERE ".DBUsers::FIELD_EMAIL."='".$email."' 
        AND ".DBUsers::FIELD_PASSWORD."='".$password."'");

        if (!$data->num_rows) {
            return null;
        }
        return DBUsers::factory($data->fetch_assoc());
    }

    /**
     * Check unique email
     * @param string $email - email for valid
     * @return int  if email already exist return 1, else 0
     */
    public function checkUniqueEmail($email)
    {
        $db = $this->_db->connect_to_db();
        $result = $db->query("SELECT * FROM `users` WHERE email = '".$email."'");
        return $result->num_rows;
    }

    /**
     * Add user to database
     * @param DBUsers $user
     * @return int
     */
    public function addUser(DBUsers $user) {
        $db = $this->_db->connect_to_db();

       return $db->query("INSERT INTO " . DBUsers::getTableName() . " (`id`, `email`, `password`, `level`, `access`, 
        `registrationDate`, `code`)
            VALUES ('" . $user->getId() . "', 
            '" . $user->getEmail() . "', 
            '" . $user->getPassword() . "', 
            '" . $user->getLevel() . "', 
            '" . $user->getAccess() . "', 
            '" . $user->getRegistrationDate() . "', 
            '" . $user->getCode() . "');");
    }

    /**
     * Retrieve user by code
     * @param string $code
     * @return null|DBUsers
     */
    public function getUserByCode($code)
    {
        $db = $this->_db->connect_to_db();
        $data = $db->query("SELECT * FROM ".DBUsers::getTableName()." WHERE ".DBUsers::FIELD_CODE."='".$code."'");

        if (!$data->num_rows) {
            return null;
        }

        return DBUsers::factory($data->fetch_assoc());
    }

    /**
     * Access user to database
     * @param DBUsers $user
     * @return int
     */
    public function accessUser(DBUsers $user)
    {
        $db = $this->_db->connect_to_db();
        $db->query("UPDATE ".DBUsers::getTableName()." SET ".DBUsers::FIELD_ACCESS." = '".$user->getAccess()."',
         ".DBUsers::FIELD_CODE." = '' WHERE ".DBUsers::FIELD_ID." = '".$user->getId()."'");

        return $db->affected_rows;
    }

    /**
     * Retrieve user by email
     * @param $email
     * @return DBUsers|null
     */
    public function getUserByEmail($email)
    {
        $db = $this->_db->connect_to_db();
        $data = $db->query("SELECT * FROM ".DBUsers::getTableName()." WHERE ".DBUsers::FIELD_EMAIL."='".$email."'");

        if (!$data->num_rows) {
            return null;
        }
        return DBUsers::factory($data->fetch_assoc());
    }

    /**
     * Get all users
     * @return array
     */
    public function getAllUsers()
    {
        $db = $this->_db->connect_to_db();
        $data = $db->query("SELECT * FROM `users` WHERE level = 'user'");

        if (!$data->num_rows) {
            return [];
        }

        $result = [];
        foreach ($data->fetch_all() as $row) {
            $row['id'] = $row[0];
            $row['email'] = $row[1];
            $row['password'] = $row[2];
            $row['level'] = $row[3];
            $row['access'] = $row[4];
            $row['registrationDate'] = $row[5];
            $row['code'] = $row[6];
            unset($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
            $result[] = DBUsers::factory($row);
        }
        return $result;
    }

    /**
     * Update user to database
     * @param $field
     * @param $id
     * @param $value
     * @param $table
     * @return int
     */
    public function updateUser($table,$field, $id, $value)
    {
        $db = $this->_db->connect_to_db();
        $db->query("UPDATE `".$table."` SET `".$field."`='".$value."' WHERE id = '".$id."'");

        return $db->affected_rows;
    }


}