<?php 
if(count($v_exceptions)>0)
foreach ($v_exceptions as $e) 
{?>
	<div id="error_box" >
	<?php if(is_array($v_exceptions))
	{?>
	<div id="error_msg" class="cx_r mb">
		<?php
		foreach ($v_exceptions as $e) 
		{?>
			<p class="ppa mpa"><?=$e->getMessage()?></p>
		<?php 
		}?>
	</div>
	<?php 
	}?>
	</div>
<?
}?>