<h2>Viewing <span class='muted'>#<?php echo $monkey->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $monkey->name; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $monkey->description; ?></p>

<?php echo Html::anchor('monkey/edit/'.$monkey->id, 'Edit'); ?> |
<?php echo Html::anchor('monkey', 'Back'); ?>