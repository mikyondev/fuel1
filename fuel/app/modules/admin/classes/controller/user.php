<?php


namespace Admin;

class Controller_User extends \Controller_Template
{

	public function action_index()
	{
		
		$data['users'] = Model_User::find('all');
		$this->template->title = "Users";
		$this->template->content = \View::forge('user/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('User');

		if ( ! $data['user'] = Model_User::find($id))
		{
			\Session::set_flash('error', 'Could not find User #'.$id);
			\Response::redirect('User');
		}

		$this->template->title = "User";
		$this->template->content = \View::forge('User/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_User::validate('create');
			
			if ($val->run())
			{
				$User = Model_User::forge(array(
					'name' => \Input::post('name'),
					'description' => \Input::post('description'),
				));

				if ($User and $User->save())
				{
					\Session::set_flash('success', 'Added User #'.$User->id.'.');

					\Response::redirect('User');
				}

				else
				{
					\Session::set_flash('error', 'Could not save User.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Users";
		$this->template->content = \View::forge('User/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('User');

		if ( ! $User = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find User #'.$id);
			Response::redirect('User');
		}

		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$User->name = Input::post('name');
			$User->description = Input::post('description');

			if ($User->save())
			{
				Session::set_flash('success', 'Updated User #' . $id);

				Response::redirect('User');
			}

			else
			{
				Session::set_flash('error', 'Could not update User #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$User->name = $val->validated('name');
				$User->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('User', $User, false);
		}

		$this->template->title = "Users";
		$this->template->content = View::forge('User/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('User');

		if ($User = Model_User::find($id))
		{
			$User->delete();

			Session::set_flash('success', 'Deleted User #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete User #'.$id);
		}

		Response::redirect('User');

	}
}