<?php
$menu = $this->o_params->getParam('v_user_menu');
if(isset($menu)) 
{
	if(count($menu)){?>
	<div id="MenuNew" class="rad5 pb">
	<?php foreach($menu as $mod)
	{
		?>
		<h3 class="hd_z"><a href="?modulo=<?=$mod->getPath();?>"><?=$mod->getNome();?></a></h3>
		<ul class="ul_um">
		<?php
		$v_smod = $mod->getChildNodes();
		if(is_array($v_smod)){
			foreach ($v_smod as $crtl){
				$v_com = $crtl->getChildNodes();
				if(!is_array($v_com)){
				?>
					<small><em>Nenum item nesta categoria</em></small>
					<?php
				}else{	
					foreach ($v_com as $com){
						?>
						<li class="li_um">
							<a href="?modulo=<?=$mod->getPath();?>&controler=<?=$crtl->getPath()?>&comando=<?=$com->getPath()?>"><?=$com->getNome()?></a>
						</li>
						<?php
					}
				}
			}
		}?>
		</ul>
		<?php
	}?>
	</div>
	<?php 
	}
}?>
