<?php

/* MENU JQUERY PRUEBAS */
function menuSuperior() {
	echo '
	<ul id="nav">
	    <li><a href="#">INICIO</a></li>
	    <li><a href="#">PODCAST</a></li>
	    <li><a href="#">TEMAS CLAVE</a></li>
   	    <li><a href="#">FORO</a>
   	    <li><a href="#">EQUIPO</a>
   	    <li><a href="#">CONTACTO</a>   	    
	</ul>';
}

/* Iconos Social Media  */
function votosSocialMedia() {
	
	echo '<div class="divVotosPost">';

	echo '<div class="votos-twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="facilware" data-lang="es" data-url="'. get_permalink() . '">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';	

	echo '<div class="votos-facebook"><iframe src="http://www.facebook.com/plugins/like.php?href='.get_permalink().'&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></div>';	

	echo '<div class="votos-plus"><g:plusone size="medium" href="'.get_permalink().'"></g:plusone></div>';
	
	echo '<div class="votos-bitacoras"><a href="http://bitacoras.com/anotaciones/'.get_permalink().'"><img src="http://widgets.bitacoras.com/votar/mini/'. get_permalink() .'" alt="votar" title="Votar esta anotación en Bitacoras.com" style="border:0" /></a></div>';
	
	echo '<div class="votos-meneame" <a href="http://meneame.net/submit.php?url='.get_permalink().'"><img src="http://www.facilware.com/es/wp-content/themes/facilware/images/meneame.png" alt="meneala" title="Menear esta nocitia en Meneame.net" style="border:0" /></a></div>';

	echo '</div>';
} 

function recuentoPostEditores() {
	global $wpdb, $table_prefix;
	$current_user = wp_get_current_user();

	// Conseguirmos fecha actual
	$fechaActual = gmdate("Y-m-d H:i:s",gmmktime(date("H")+1, date("i"), date("s"), date("m"), date("d"), date("Y")));
	// Obtenemos los ID de los colaboradores
	$usrid = $wpdb->get_results("SELECT DISTINCT user_id FROM ".$wpdb->prefix."usermeta WHERE meta_value LIKE '%author%' OR meta_value LIKE '%administrator%'");

	echo '<table class= "rankings">';
	echo '<tr class="primeraFila"><td>Top</td><td>Editor</td><td>Articulos</td></tr>';
	$top=1;

	foreach ($usrid as $key) {
	 
		$user_id = $key->user_id.' ';
		// Conseguimos el nickname a partir del ID del colaborador
		$nick = $wpdb->get_var("SELECT meta_value FROM $wpdb->usermeta WHERE meta_key='nickname' AND user_id = '$user_id'");

		// Construimos pares de "nick => ID"
		$id[$nick]=$user_id;

		// Obtenemos los post publicados			
		$publicadas[$nick] = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}posts WHERE post_status='publish' AND post_author=$user_id AND post_date >= '2012-01-01'");
	}	
		arsort($publicadas);
		
		foreach($publicadas as $user => $numpost){
			if ($top % 2 == 0) {
				echo '<tr class="filaPar">';
			}
			else {
				echo '<tr class="filaImpar">';
			}
			if ($top <= 19) {
				if((int)$current_user->ID == (int)$id[$user]){
					echo '<td class="soyYoPrimera">'.$top.'</td><td class="soyYo"><strong><a href="'.$url.'./author/'.$user.'">'.$user.'</strong></td><td class="soyYo"><strong>'.$publicadas[$user].'</strong></td></tr>';
					$top=$top+1;
				}
				else{
					echo '<td class="primCelda">'.$top.'</td><td><a href="'.$url.'./author/'.$user.'">'.$user.'</td><td>'.$publicadas[$user].'</td></tr>';
					$top=$top+1;
				}
			}
			else {
				break;
			}
		}
		
	echo '</table>';
}

?>