<?php

class PollModel extends Model
{
	public $id;
	public $poll;
	public $vote;
	public $user_id;
	
	public function getVoteByUserIdAndPoll($user_id, $poll){
		
		$sql  = "SELECT id, user_id, poll, vote FROM polls WHERE user_id = :user_id AND poll = :poll";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id,':poll' => $poll);
		$query->execute($parameters);
		
		return $query->fetch();
	}

	
	public function getAllVoteByUserId($user_id){
	
		$sql  = "SELECT id, user_id, poll, vote FROM polls WHERE user_id = :user_id";
		$query = $this->db->prepare($sql);
		$parameters = array(':user_id' => $user_id);
		$query->execute($parameters);
	
		return $query->fetchAll();
	}

	
	public function getCountOfVoteByPoll($poll){
	
		$sql  = "SELECT count(*) as count FROM polls WHERE poll = :poll AND vote = 1";
		$query = $this->db->prepare($sql);
		$parameters = array(':poll' => $poll);
		$query->execute($parameters);
	
		return $query->fetch();
	}
	
	
	public function setVoteByUserId($user_id, $poll, $vote){
		
		if (!empty($this->getVoteByUserIdAndPoll($user_id, $poll)->id)){
			$sql  = "UPDATE polls SET vote = :vote, updated_at = NOW() WHERE user_id = :user_id AND poll = :poll";				
		} else {
			$sql  = "INSERT INTO polls (user_id, poll, vote, created_at, updated_at) VALUES (:user_id, :poll, :vote, NOW(), NOW())";
		}
		$parameters = array(':user_id' => $user_id, ':poll' => $poll, ':vote' => $vote);
		$query = $this->db->prepare($sql);
		
		$query->execute($parameters);
	}
	
}