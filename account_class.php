<?php

class Account
{
    private $id;
    private $email;
    private $firstname;
    private $surname;
    private $authenticated;
	
	public function __construct()
	{
		$this->id = NULL;
		$this->email = NULL;
        $this->authenticated = FALSE;
        $this->configs = include('config.php');
	}
	
    public function __destruct(){ }
    
    public function getId() 
    {
        return $this->id;
    }

    public function getEmail() 
    {
        return $this->email;
    }
    
    public function addAccount(string $email, string $firstname, string $surname, string $passwd): int
    {
        // TODO: Added new references to code
        global $pdo;
        
        $email = trim($email);
        $firstname = trim($firstname);
        $surname = trim($surname);
        $passwd = trim($passwd);

        if (!$this->isEmailValid($email)){ throw new Exception('Invalid user email'); }
        if (!$this->isFirstnameValid($firstname)){ throw new Exception('Invalid user firstname'); }
        if (!$this->isSurnameValid($surname)){ throw new Exception('Invalid user surnname'); }
        if (!$this->isPasswdValid($passwd)){ throw new Exception('Invalid password'); }
        if (!is_null($this->getIdFromName($email))){ throw new Exception('User not available'); }

        $query = 'INSERT INTO '.$this->configs['db_name'].'.accounts (account_mail, account_passwd, account_firstname, account_surname) VALUES (:email, :passwd, :firstname, :surname)';

        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $values = array(':email' => $email, ':passwd' => $hash, ':firstname' => $firstname, ':surname' => $surname);
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e){ throw new Exception('Database query error'); }

        return $pdo->lastInsertId();
    }
   
    public function isIdValid(int $id): bool
    {
        $valid = TRUE;

        if (($id < 1) || ($id > 1000000)) { $valid = FALSE; }

        return $valid;
    }

    public function isEmailValid(string $email): bool
    {
        $valid = TRUE;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = TRUE;
          } else {
            $valid = FALSE;
          }
        
        return $valid;
    }

    public function isFirstnameValid(string $name): bool
    {
        $valid = TRUE;
        $len = mb_strlen($name);
        
        if (($len < 0) || ($len > 16)) { $valid = FALSE; }
        
        return $valid;
    }

    public function isSurnameValid(string $name): bool
    {
        $valid = TRUE;
        $len = mb_strlen($name);
        
        if (($len < 0) || ($len > 16)) { $valid = FALSE; }
        
        return $valid;
    }

    public function isPasswdValid(string $passwd): bool
    {
        $valid = TRUE;
        $len = mb_strlen($passwd);
        
        if (($len < 8) || ($len > 16)) { $valid = FALSE; }
        
        return $valid;
    }

    public function getIdFromName(string $name): ?int
    {
        global $pdo;
        
        if (!$this->isEmailValid($name)) { throw new Exception('Invalid user name'); }
        
        $id = NULL;
        $query = 'SELECT account_id FROM '.$this->configs['db_name'].'.accounts WHERE (account_mail = :name)';
        $values = array(':name' => $name);
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e) { throw new Exception('Database query error'); }
        
        $row = $res->fetch(PDO::FETCH_ASSOC);
        
        if (is_array($row)) { $id = intval($row['account_id'], 10); }
        
        return $id;
    }

    public function editAccount(int $id, string $name, string $passwd, bool $enabled)
    {
        // TODO: Edit to repair
        global $pdo;

        $name = trim($name);
        $passwd = trim($passwd);
        
        if (!$this->isIdValid($id)) { throw new Exception('Invalid account ID'); }
        if (!$this->isNameValid($name)) { throw new Exception('Invalid user name'); }
        if (!$this->isPasswdValid($passwd)) { throw new Exception('Invalid password'); }
        
        $idFromName = $this->getIdFromName($name);
        
        if (!is_null($idFromName) && ($idFromName != $id)) { throw new Exception('User name already used'); }
        
        $query = 'UPDATE '.$this->configs['db_name'].'.accounts SET account_name = :name, account_passwd = :passwd, account_enabled = :enabled WHERE account_id = :id';
        $hash = password_hash($passwd, PASSWORD_DEFAULT);
        $intEnabled = $enabled ? 1 : 0;
        $values = array(':name' => $name, ':passwd' => $hash, ':enabled' => $intEnabled, ':id' => $id);
        
        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e) { throw new Exception('Database query error'); }
    }

    public function deleteAccount(int $id)
    {
        global $pdo;

        if(!$this->isIdValid($id)) { throw new Exception('Invalid accound ID'); }

        $query = 'DELETE FROM '.$this->configs['db_name'].'.accounts WHERE account_id = :id';
        $values = array(':id' => $id);

        try
        {
            $res = $pdo->prepare($query);
		    $res->execute($values);
        }
        catch (PDOException $e) { throw new Exception('Database query error'); }
        
	    $query = 'DELETE FROM '.$this->configs['db_name'].'.account_sessions WHERE (account_id = :id)';
	    $values = array(':id' => $id);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e) { throw new Exception('Database query error'); }
    }
    
    public function login(string $email, string $passwd): bool
    {
        global $pdo;

        $email = trim($email);
        $passwd = trim($passwd);

        if(!$this->isEmailValid($email)) { return FALSE; }
        if(!$this->isPasswdValid($passwd)) { return FALSE; }

        $query = 'SELECT * FROM '.$this->configs['db_name'].'.accounts WHERE (account_mail = :email) AND (account_enabled = 1)';
        $values = array(':email' => $email);

        try
        {
            $res = $pdo->prepare($query);
            $res->execute($values);
        }
        catch (PDOException $e) { throw new Exception('Database query error'); }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        if(is_array($row))
        {
            if(password_verify($passwd, $row['account_passwd']))
            {
                $this->id = intval($row['accound_id'], 10);
                $this->email = $email;
                $this->authenticated = TRUE;
                $this->registerLoginSession();
                return TRUE;
            }
        }
        return FALSE;
    }

    private function registerLoginSession()
    {
        global $pdo;

        if (session_status() == PHP_SESSION_ACTIVE)
        {
            $query = 'REPLACE INTO '.$this->configs['db_name'].'.account_session (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
            $values = array(':sid' => session_id(), ':accountId' => $this->id);

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e) { throw new Exception('Databse query error'); }
        }
    }

    public function sessionLogin(): bool
    {
        global $pdo;

        if(session_status() == PHP_SESSION_ACTIVE)
        {
            $query =
            'SELECT * FROM '.$this->configs['db_name'].'.account_sessions, '.$this->configs['db_name'].'.accounts WHERE (account_sessions.session_id = :sid) ' . 
		    'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
            'AND (accounts.account_enabled = 1)';
            
            $values = array(':sid' => session_id());

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e) { throw new Exception('Database query error'); }

            $row = $res->fetch(PDO::FETCH_ASSOC);
		
            if (is_array($row))
            {
                $this->id = intval($row['account_id'], 10);
                $this->email = $row['account_mail'];
                $this->authenticated = TRUE;
                
                return TRUE;
            }
        }
        return FALSE;
    }

    public function logout()
    {
        global $pdo;

        if(is_null($this->id)) { return; }

        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;

        if(session_status() == PHP_SESSION_ACTIVE)
        {
            $query = 'DELETE FROM '.$this->configs['db_name'].'.account_sessions WHERE (session_id = :sid)';
            $values = array(':sid' => session_id());

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch(PDOException $e) { throw new Exception('Database query error'); }
        }
    }
    
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

    public function closeOtherSession()
    {
        global $pdo;

        if(is_null($this->id)) { return; }
        
        if(session_status() == PHP_SESSION_ACTIVE)
        {
		    $query = 'DELETE FROM '.$this->configs['db_name'].'.account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';
		    $values = array(':sid' => session_id(), ':account_id' => $this->id);

            try
            {
                $res = $pdo->prepare($query);
                $res->execute($values);
            }
            catch (PDOException $e) { throw new Exception('Database query error'); }
        }
    }
}
