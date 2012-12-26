<?php 
$value = $this->o_params->getParam('action_value');
$name = $this->o_params->getParam('action_name');
?>
<form method="POST">
<input type="hidden" name="action"  value="<?=$o_action->getPath();?>">
<input type="hidden" name="<?=$name?>"  value="<?=$value;?>">
<input type="submit" class="bt_gray" title="<?=$o_action->getNome();?>" value="<?=$o_action->getNome();?>" >
<?php /*<button	class="bt_gray" title="<?=$o_action->getNome();?>" name="<?=$name?>" value="<?=$value;?>"><?=$o_action->getNome();?></button>*/?>
</form>