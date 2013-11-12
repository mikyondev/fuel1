<?php
class Controller_Test extends Controller_Template{

	public function action_index()
	{
		$data['tests'] = Model_Test::find('all');
		$this->template->title = "Tests";
		$this->template->content = View::forge('test/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('test');

		if ( ! $data['test'] = Model_Test::find($id))
		{
			Session::set_flash('error', 'Could not find test #'.$id);
			Response::redirect('test');
		}

		$this->template->title = "Test";
		$this->template->content = View::forge('test/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Test::validate('create');
			
			if ($val->run())
			{
				$test = Model_Test::forge(array(
					'description' => Input::post('description'),
				));

				if ($test and $test->save())
				{
					Session::set_flash('success', 'Added test #'.$test->id.'.');

					Response::redirect('test');
				}

				else
				{
					Session::set_flash('error', 'Could not save test.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tests";
		$this->template->content = View::forge('test/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('test');

		if ( ! $test = Model_Test::find($id))
		{
			Session::set_flash('error', 'Could not find test #'.$id);
			Response::redirect('test');
		}

		$val = Model_Test::validate('edit');

		if ($val->run())
		{
			$test->description = Input::post('description');

			if ($test->save())
			{
				Session::set_flash('success', 'Updated test #' . $id);

				Response::redirect('test');
			}

			else
			{
				Session::set_flash('error', 'Could not update test #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$test->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('test', $test, false);
		}

		$this->template->title = "Tests";
		$this->template->content = View::forge('test/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('test');

		if ($test = Model_Test::find($id))
		{
			$test->delete();

			Session::set_flash('success', 'Deleted test #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete test #'.$id);
		}

		Response::redirect('test');

	}


}
