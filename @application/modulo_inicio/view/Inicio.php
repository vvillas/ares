<?php
$cpa_pct 	= $params->getParam('cpa_pct'); 
if(is_numeric($cpa_pct) && $cpa_pct < 100)
{
?>
<div>
	<h4 class="ppb mb ul">Avaliação Institucional</h4>
	<div class="pa cx_y">
	<p>Diante da necessidade de redimensionamento das Instituições de Educação Superior no âmbito da realidade histórico-social brasileira atribui-se à Avaliação Institucional importância de instrumento gerencial e pedagógico. Sob essa ótica, a Avaliação Institucional deixa de lado a compreensão de objeto de caráter apenas burocrático e controlador para assumir uma dimensão institucionalizada e processual, marcando um ponto de partida para a análise e reflexão acerca das reais necessidades da instituição. </p>
	<p>Face ao exposto, convidamos você a participar de mais essa etapa de fundamental importância para a UBC. Você responderá a um questionário com 23 questões de forma apócrifa nos quesitos: autoavaliação; aula; apoio pedagógico; projeto integrador e portal educacional. </p>
	<p>A fim de atingirmos os objetivos propostos, elaboramos a avaliação voltada para os seguintes conceitos: </p>
	
	<ul class="mb">
	  <li> Muito bom </li>
	  <li>Bom </li>
	  <li>Regular </li>
	  <li>Deficiente </li>
	  <li>Muito deficiente </li>
	  <li>Não tenho como avaliar </li>
	</ul>
	<p>Antecipadamente agradecemos. </p>
	<p><strong><em>Comissão Própria de Avaliação </em></strong></p>
	<hr>
	<div class="ppt"><?php $this->showProgressBar($cpa_pct, 'Progresso da sua Avaliação');?></div>
	<div align="center" class="pt"><a href="?modulo=institucional&controler=inicio&comando=avaliacaoInstitucional" class="bt_blue bt_g">Responder Avaliação</a></div>
	</div>
</div>
<?php 
}?>
<div>
	<h4 class="ppb mb ul">Editais</h4>
	<p><a
		href="http://www3.brazcubas.br/ADAGP/documentos/09_2012_EXTRAORDINARIO_APROVEITAMENTO_DE_ESTUDOS.pdf">EDITAL
			N&ordm; 09/12 - EXTRAORDIN&Aacute;RIO APROVEITAMENTO DE ESTUDOS </a>
	</p>
	<p><a
		href="http://www3.brazcubas.br/ADAGP/documentos/10_2012_DEPENDENCIAS_E_ADAPTACOES_SEM_LISTA_DE_DISCIPLINAS.pdf">EDITAL
			N&ordm; 10/12 - DEPEND&Ecirc;NCIAS E ADAPTA&Ccedil;&Otilde;ES </a>
	</p>
</div>


<?php

//var_dump($params->getParam('mensagens'));

?>