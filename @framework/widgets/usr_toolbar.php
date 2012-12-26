<?php 
$toolbar = $this->o_params->getParam('v_user_toolbar');
if($toolbar)
if(count($toolbar)>0)
{
	?>
	<div id="toolbar" class="rad5 mb">
	<form method="POST">
		<ul class="toolbar flr">
			<?php 
			if(isset($toolbar))
			if(is_array($toolbar))
			foreach ($toolbar as $act) {
			?>
			<li>
				<input type="button" class="bt" name="action" value="<?=$act->getPath();?>" title="<?=$act->getNome();?>">
			</li>
			<?php 
			}?>
		</ul>
	</form>
</div>
<?php 
}