// Developed By : Abishek | Nair
// Copyright    : White | Hat tm
<?php
	mysqli_report(MYSQLI_REPORT_ALL);
	class whSQLLogin {
		public $dbConn;
		public $dbUserName;
		public $dbPassword;
		public $dbHost;
		public $dbDatabase;
		public $whUsername;
		public $whPassword;
		// public $timeOut;
		public $levelsComplete;
		public $whUserID;

		function __construct() {
			$this->dbUserName = 'ENTER DB USER NAME';
			$this->dbPassword = 'ENTER DB PASSWORD';
			$this->dbHost = 'ENTER DB HOSTNAME';
			$this->dbDatabase = 'ENTER DB NAME';
		}
		function setLoginParam($name, $pass) {
			$this->whUsername = $name;
			$this->whPassword = $pass;				
		}
		function checkUserDB() {
			if(preg_match("#[^A-Za-z]#", $this->whUsername)) {
				return array("ERROR" => "INVALIDNAME");
			}
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}
			$query = $dbConn->prepare("SELECT id, user_name, password, levels_completed FROM wh_users WHERE user_name = ?");
			$queryTime = $dbConn->prepare("UPDATE wh_users SET last_login = ? WHERE id = ?");
			$query->bind_param('s', $this->whUsername);
			$query->execute();
			$query->bind_result($retId, $retUserName, $retPassword, $retLevelsComplete);
			$query->fetch();
			if(!empty($retUserName) && !empty($retPassword) && $retId > 0) {
				if($retPassword === $this->whPassword) {
					$timestamp = date('Y-m-d H:i:s', time());
					$query->close();
					$queryTime->bind_param('si', $timestamp, $retId);
					$queryTime->execute();
					$this->levelsComplete = $retLevelsComplete;
					$this->whUserID = $retId;
					return array("STATUS" => "LOGINSUCCESS");
				}
				else {
					return array("STATUS" => "LOGINFAIL");
				}
			}
			else {
				return array("STATUS" => "NOUSERNAME");
			}
		}
		function checkAdminDB() {
			if(preg_match("#[^A-Za-z]#", $this->whUsername)) {
				return array("ERROR" => "INVALIDNAME");
			}				
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}

			$query = $dbConn->prepare("SELECT id, user_name, password FROM wh_admin WHERE user_name = ?");
			$query->bind_param('s', $this->whUsername);
			$query->execute();
			$query->bind_result($retId, $retUserName, $retPassword);
			$query->fetch();
			if(!empty($retUserName) && !empty($retPassword)) {
				if($retPassword === $this->whPassword) {
					return array("STATUS" => "LOGINSUCCESS");
				}
				else {
					return array("STATUS" => "LOGINFAIL");
				}
			}
			else {
				return array("STATUS" => "NOUSERNAME");
			}			
		}
		function updateLevels($currLevel, $id, $timeStart) {
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}
			$queryFetchLvl = $dbConn->prepare("SELECT levels_completed FROM wh_users WHERE id = ?");
			$queryUpdateLvl = $dbConn->prepare("UPDATE wh_users SET levels_completed = ? WHERE id = ?");

			$queryFetchLvl->bind_param('i', $id);
			$queryFetchLvl->execute();
			$queryFetchLvl->bind_result($levelOld);
			$queryFetchLvl->fetch();
			$queryFetchLvl->close();

			$tempArr = unserialize($levelOld);
			$tempArr['stage'.$currLevel] = 1;
			$level =serialize($tempArr);

			$queryUpdateLvl->bind_param('si', $level, $id);
			$queryUpdateLvl->execute();
			$queryUpdateLvl->close();

			$queryFetchTime = $dbConn->prepare("SELECT id FROM wh_time WHERE id = ?");

			$queryFetchTime->bind_param('i', $id);
			$queryFetchTime->execute();
			$queryFetchTime->bind_result($retId);
			$queryFetchTime->fetch();
			$queryFetchTime->close();

			if(empty($retId)) {
				$queryUpdateTime = $dbConn->prepare("INSERT INTO wh_time(stage".$currLevel.", id) VALUES (?, ?)");
			}
			else {
				$queryUpdateTime = $dbConn->prepare("UPDATE wh_time SET stage".$currLevel." = ? WHERE id = ?");
			}

			// $time = date("Y-m-d H:i:s" , time());
			$time = time() - $timeStart;
			$queryUpdateTime->bind_param('si',$time , $id);
			$queryUpdateTime->execute();
			$queryUpdateTime->close();
		}
		function getLevels($id) {
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}
			$query = $dbConn->prepare("SELECT levels_completed FROM wh_users WHERE id = ?");
			$query->bind_param('i', $id);
			$query->execute();

			$query->bind_result($retLevel);
			$query->fetch();
			$query->close();

			return unserialize($retLevel);
		}
		function getPlayerTime() {
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}
			try {
				$query = $dbConn->prepare("SELECT id, stage1, stage2, stage3, stage4, stage5 FROM wh_time WHERE 1");			
				$query->execute();
			}
			catch (Exception $e) {
			}
			$stage = array();
			$query->bind_result($id, $st1, $st2, $st3, $st4, $st5);
			while($query->fetch()) {
				$temp[$id] = array(1 => $st1, $st2, $st3, $st4, $st5);
			}
			$query->close();
			return $temp;
		}
		function getPlayerInfo($id) {
			$dbConn = new mysqli($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbDatabase);
			if($dbConn->connect_errno > 0) {
				return array("ERROR" => "DBCONNECTERROR");
			}
			$query = $dbConn->prepare("SELECT register_no, user_name, college, contact_no FROM wh_users WHERE id = ?");					
			$query->bind_param('i', $id);
			$query->execute();
			$query->bind_result($regNo, $uName, $collName, $contactNo);
			$query->fetch();
			$query->close();

			return array(
					'register_no' =>$regNo,
					'name' => $uName,
					'college_name' => $collName,
					'contact_no' => $contactNo
				);
		}
	}

?>
