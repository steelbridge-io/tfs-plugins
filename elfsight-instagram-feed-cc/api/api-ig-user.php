<?php

namespace ElfsightInstagramFeedApi;


class IGUser {
    private $Helper;

    private $cacheTime;

    private $tableName;

    public function __construct($Helper, $config) {
        $this->Helper = $Helper;
        $this->cacheTime = !empty($config['cache_time']) ? $config['cache_time'] : 168 * 3600;

        $this->tableName = $this->Helper->getTableName('ig_user');

        if (!$this->Helper->tableExist($this->tableName)) {
            $this->Helper->tableCreate($this->tableName, array('username' => 'varchar(255)', 'data' => 'longtext'));
        }
    }

    public function get($username, $check_expire = true) {
        $cache = $this->Helper->tableRowGet($this->tableName, array('username' => $username));

        if (!$cache || ($check_expire && time() > $cache['updated_at'] + $this->cacheTime)) {
            return null;
        }

        return json_decode($cache['data'], true);
    }

    public function set($username, $data) {
        if (empty($data)) {
            return false;
        }

        $data = is_array($data) ? json_encode($data) : $data;

        return !!$this->Helper->tableRowUpdate(
            $this->tableName,
            array(
                'username' => $username,
                'data' => $data
            ),
            array('username' => $username)
        );
    }
}
