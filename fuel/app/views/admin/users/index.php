<h2>Listing Users</h2>
<br>
<?php if ($users): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Group id</th>
			<th>Email</th>
			<th>Last login</th>
			<th>Previous login</th>
			<th>Login hash</th>
			<th>User id</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>		<tr>

			<td><?php echo $item->username; ?></td>
			<td><?php echo $item->password; ?></td>
			<td><?php echo $item->group_id; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->last_login; ?></td>
			<td><?php echo $item->previous_login; ?></td>
			<td><?php echo $item->login_hash; ?></td>
			<td><?php echo $item->user_id; ?></td>
			<td>
				<?php echo Html::anchor('admin/users/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/users/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/users/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Users.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/users/create', 'Add new User', array('class' => 'btn btn-success')); ?>

</p>
