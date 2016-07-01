<table class="table">
	<tbody>
	<tr>
		<td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('name'); ?></td>
		<td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->name; ?></div></td>
	</tr>
	<tr>
		<td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('email'); ?></td>
		<td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->email; ?></div></td>
	</tr>
	<tr>
		<td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('phone'); ?></td>
		<td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->phone; ?></div></td>
	</tr>
	<tr>
		<td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('country'); ?></td>
		<td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo CatalogTree::model()->active()->findByPk($model->country)->title ;?></div></td>
	</tr>
	<tr>
		<td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('questions'); ?></td>
		<td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->questions; ?></div></td>
	</tr>
	</tbody>
</table>