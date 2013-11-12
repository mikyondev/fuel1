<h2>Listing <span class='muted'>Monkeys</span></h2>
<br>
<?php if ($monkeys): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($monkeys as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->description; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('monkey/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('monkey/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('monkey/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Monkeys.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('monkey/create', 'Add new Monkey', array('class' => 'btn btn-success')); ?>

</p>
