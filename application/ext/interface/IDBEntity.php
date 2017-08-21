<?php

interface IDBEntity
{
    /**
     * Convert object to array
     * @return array
     */
    public function toArray();

    /**
     * Create object from data array
     * @static
     * @param array $data - data for object
     * @return IDBEntity
     */
    public static function factory(array $data);

    /**
     * Return array with table fields names
     * @return array
     */
    public static function getAllFieldsNames();

    /**
     * Return table name
     * @return String
     */
    public static function getTableName();
}