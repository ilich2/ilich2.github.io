<?php

include PATH.'/application/ext/interface/IDBEntity.php';
include PATH.'/application/ext/enums/ILevelEnum.php';

class DBUsers implements IDBEntity
{
    const FIELD_ID = 'id';
    const FIELD_PASSWORD = 'password';
    const FIELD_EMAIL = 'email';
    const FIELD_ACCESS = 'access';
    const FIELD_LEVEL = 'level';
    const FIELD_CODE = 'code';
    const FIELD_REGISTRATION_DATE = 'registrationDate';
    /**
     * @var int
     */
    private $_id = 0;
    /**
     * @var string
     */
    private $_password = '';
    /**
     * @var string
     */
    private $_email = '';
    /**
     * @var int
     */
    private $_access = 0;
    /**
     * @var array
     */
    private $_arrayLevel = [ILevelEnum::LEVEL_USER, ILevelEnum::LEVEL_ADMIN];
    /**
     * @var string
     */
    private $_level = '';
    /**
     * @var string
     */
    private $_code = '';
    /**
     * @var int
     */
    private $_registrationDate = 0;

    /**
     * @var string
     */
    private static $_table = 'users';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = (int)$id;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    /**
     * @return int
     */
    public function getRegistrationDate()
    {
        return $this->_registrationDate;
    }

    /**
     * @param int $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->_registrationDate = (int)$registrationDate;
    }

    /**
     * @return int
     */
    public function getAccess()
    {
        return $this->_access;
    }

    /**
     * @param int $access
     */
    public function setAccess($access)
    {
        $this->_access = (int)$access;
    }

    /**
     * @return string
     */
    public function getLevel() {
        return $this->_level;
    }

    /**
     * @param string $level
     * @throws Exception
     */
    public function setLevel($level) {
        if (in_array($level, $this->_arrayLevel)) {
            $this->_level = $level;
        }
        else {
            throw new Exception('There is no such type of user');
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
                self::FIELD_ID => $this->_id,
                self::FIELD_PASSWORD => $this->_password,
                self::FIELD_EMAIL => $this->_email,
                self::FIELD_REGISTRATION_DATE => $this->_registrationDate,
                self::FIELD_CODE => $this->_code,
                self::FIELD_ACCESS => $this->_access,
                self::FIELD_LEVEL => $this->_level
        ];
    }

    /**
     * @param array $data
     * @return DBUsers
     */
    public static function factory(array $data)
    {
        $obj = new DBUsers();
        if (isset($data['id'])) {
            $obj->setId($data['id']);
        }
        if(isset($data['password'])){
            $obj->setPassword($data['password']);
        }
        if(isset($data['email'])){
            $obj->setEmail($data['email']);
        }
        if(isset($data['registrationDate'])) {
            $obj->setRegistrationDate($data['registrationDate']);
        }
        if(isset($data['code'])){
            $obj->setCode($data['code']);
        }
        if(isset($data['access'])){
            $obj->setAccess($data['access']);
        }
        if(isset($data['level'])){
            $obj->setLevel($data['level']);
        }
        return $obj;
    }

    /**
     * @return array
     */
    public static function getAllFieldsNames()
    {
        return [
                self::FIELD_ID,
                self::FIELD_PASSWORD,
                self::FIELD_EMAIL,
                self::FIELD_REGISTRATION_DATE,
                self::FIELD_CODE,
                self::FIELD_ACCESS,
                self::FIELD_LEVEL
        ];
    }

    /**
     * @return string
     */
    public static function getTableName()
    {
        return self::$_table;
    }


}