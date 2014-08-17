<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = Users::model()->find('LOWER(user_login)=:name', array(':name'=>strtolower($this->username)));
		if(empty($user))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!$this->verifyPassword($this->password, $user->user_pass))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
            $this->_id = $user->ID;
            $this->setState('user_name', $user->user_nicename);
            $this->errorCode=self::ERROR_NONE;
        }

		return !$this->errorCode;
	}

    public function getId()
    {
        return $this->_id;
    }

    protected function verifyPassword($password, $hash)
    {
        return CPasswordHelper::verifyPassword($password, $hash);
    }
}