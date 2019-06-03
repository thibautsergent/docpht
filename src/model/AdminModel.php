<?php

/**
 * This file is part of the DocPHT project.
 * 
 * @author Valentino Pesce
 * @copyright (c) Valentino Pesce <valentino@iltuobrand.it>
 * @copyright (c) Craig Crosby <creecros@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DocPHT\Model;

use Instant\Core\Model\AbstractModel;


class Admin extends AbstractModel
{
    const USERS = 'src/config/users.json';
    
    /**
     * connect
     *
     *
     * @return array
     */
    public function connect()
    {
		if(!file_exists(self::USERS))
		{
		    file_put_contents(self::USERS,[]);
		} 
		
		return json_decode(file_get_contents(self::USERS),true);
    }

    /**
     * create
     *
     * @param  array $values
     *
     * @return array
     */
    public function create($values)
    {
        $data = $this->connect();
        $data[] = array(
            'Username' => $values['username'],
            'Password' => password_hash($values['password'], PASSWORD_DEFAULT),
            'Language' => $values['translations']
            );
            
        return $this->disconnect(self::USERS, $data);
    }
    
    /**
     * verifyPassword
     *
     * @param  string $username
     * @param  string $password
     *
     * @return boolean
     */
    public function verifyPassword($username, $password)
    {
        $data = $this->connect();
        $key = array_search($username, array_column($data, 'Username'));
        
        return password_verify($data[$key]['password'], $password);
    }
    
    /**
     * updatePassword
     *
     * @param  string $username
     * @param  string $password
     * 
     * @return array
     */
    public function updatePassword($username, $password)
    {
        $data = $this->connect();
        $key = array_search($username, array_column($data, 'Username'));
        
        $data[$key]['Password'] = password_hash($password, PASSWORD_DEFAULT);
        
        return $this->disconnect(self::USERS, $data);
    }

    /**
     * updateTrans
     *
     * @param  string $username
     * @param  string $translation
     * 
     * @return array
     */
    public function updateTrans($username, $translation)
    {
        $data = $this->connect();
        $key = array_search($username, array_column($data, 'Username'));
        
        $data[$key]['translation'] = $translation;
        
        return $this->disconnect(self::USERS, $data);
    }
    
    /**
     * removeUser
     *
     * @param  string $userindex
     * 
     * @return array
     */
    public function removeUser($userindex)
    {
        $data = $this->connect();

        array_splice($data, $userindex, 1); 
        
        return $this->disconnect(self::USERS, $data);
    }

    /**
     * userExists
     *
     * @param  string $user
     * 
     * @return boolean
     */
    public function userExists($user)
    {
        return in_array($user, $this->getUsernames());
    }

    /**
     * getUsernames
     *
     * @return array
     */
    public function getUsernames()
    {
        $data = $this->connect();

        $usernames = array_column($data, 'Username');
        
        return $usernames;
    }

    /**
     * disconnect
     *
     * @param  string $path
     * @param  array $data
     *
     * @return array
     */
    public function disconnect($path, $data)
    {
        return file_put_contents($path, json_encode($data));
    }
    
    /**
     * getUsers
     *
     *
     * @return array
     */
    public function getUsers()
    {
        $data = $this->connect();

        return $data;
    }

}