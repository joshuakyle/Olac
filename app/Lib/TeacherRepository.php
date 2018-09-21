<?php

namespace App\Lib;
use App\Model\Teacher;
use App\Model\User;
use DB;
/**
* 	
*/
class TeacherRepository
{
	private $teacher;
	function __construct(Teacher $teacher)
	{
		$this->teacher = $teacher;
	}

	public function getTeachers()
	{
		return $this->teacher
			->select('teachers.*','u.email')
			->join('users as u','u.id','=','teachers.user_id')
			->get();
	}

	public function getTeacher($id)
	{
		return $this->teacher
			->select('teachers.*','u.email','u.username')
			->addSelect(DB::raw('u.id as user_id'))
			->join('users as u','u.id','=','teachers.user_id')
			->where('teachers.id',$id)
			->get();
	}

	public function createTeacher(
		$firstname,
		$lastname,
		$email,
		$contactNumber,
		$gender,
		$birthdate,
		$username,
		$password,
		$type
	)
	{
		$user = new User;
		$password = bcrypt($password);
		$birthdate = date("Y-m-d", strtotime($birthdate));
		$query = $user->insertGetId([
			'email' => $email,
			'username' => $username,
			'password' => $password,
			'remember_token' => null,
			'user_role' => 1,
			'created_at' => date('Y-m-d H:i:s'),
		]);
		if(!is_null($query)){
			$this->teacher->insert([
				'user_id' => $query,
				'first_name' => $firstname,
				'last_name' => $lastname,
				'contact_number' => $contactNumber,
				'gender' => $gender,
				'birth_date' => $birthdate,
				'created_at' => date('Y-m-d H:i:s'),
				'type' => $type
			]);
		}else{
			return null;
		}
	}

	public function updateTeacher(
		$firstname,
		$lastname,
		$email,
		$contactNumber,
		$gender,
		$birthdate,
		$username,
		$userId,
		$id,
		$type
	)
	{
		$user = new User;
		// $password = bcrypt($password);
		$birthdate = date("Y-m-d", strtotime($birthdate));

		$query = $user->where('id',$userId)->update([
			'email' => $email,
			'username' => $username,
		]);

		$this->teacher->where('id',$id)->update([
			'first_name' => $firstname,
			'last_name' => $lastname,
			'contact_number' => $contactNumber,
			'gender' => $gender,
			'birth_date' => $birthdate,
			'updated_at' => date('Y-m-d H:i:s'),
			'type' => $type
		]);

	}

	public function delete($id)
	{
		$user = new User;
		$this->teacher->where('user_id',$id)->delete();
		$user->where('id',$id)->delete();
		return true;
	}
}