<?php
class Controller_Monkey extends Controller_Template{

	public function action_index()
	{
		$data['monkeys'] = Model_Monkey::find('all');
		$this->template->title = "Monkeys";
		$this->template->content = View::forge('monkey/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('monkey');

		if ( ! $data['monkey'] = Model_Monkey::find($id))
		{
			Session::set_flash('error', 'Could not find monkey #'.$id);
			Response::redirect('monkey');
		}

		$this->template->title = "Monkey";
		$this->template->content = View::forge('monkey/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Monkey::validate('create');
			
			if ($val->run())
			{
				$monkey = Model_Monkey::forge(array(
					'name' => Input::post('name'),
					'description' => Input::post('description'),
				));

				if ($monkey and $monkey->save())
				{
					Session::set_flash('success', 'Added monkey #'.$monkey->id.'.');

					Response::redirect('monkey');
				}

				else
				{
					Session::set_flash('error', 'Could not save monkey.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Monkeys";
		$this->template->content = View::forge('monkey/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('monkey');

		if ( ! $monkey = Model_Monkey::find($id))
		{
			Session::set_flash('error', 'Could not find monkey #'.$id);
			Response::redirect('monkey');
		}

		$val = Model_Monkey::validate('edit');

		if ($val->run())
		{
			$monkey->name = Input::post('name');
			$monkey->description = Input::post('description');

			if ($monkey->save())
			{
				Session::set_flash('success', 'Updated monkey #' . $id);

				Response::redirect('monkey');
			}

			else
			{
				Session::set_flash('error', 'Could not update monkey #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$monkey->name = $val->validated('name');
				$monkey->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('monkey', $monkey, false);
		}

		$this->template->title = "Monkeys";
		$this->template->content = View::forge('monkey/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('monkey');

		if ($monkey = Model_Monkey::find($id))
		{
			$monkey->delete();

			Session::set_flash('success', 'Deleted monkey #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete monkey #'.$id);
		}

		Response::redirect('monkey');

	}


}
