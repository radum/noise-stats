			<div id="content-full">
				<div class="post">
					<h2 class="title"><a href="#">Rezultatele cautarii:</a></h2>
					<div class="entry"> <img src="<?=base_url()?>assets/images/template/search_logo.png" alt="" class="right" />
						<p>
							<?if($foundUsers == false):?>
								Nu exista nici un utilizator in baza de date cu acest username :( 
							<?else:?>
								<table cellpadding="10" cellspacing="10">
								<?foreach($foundUsers->result() as $row):?>
								<tr>								
									<td><a href="http://noisestats.radumicu.info/profile/usr/<?echo $row->username?>"><img src="http://friedcellcollective.net/monsterid/bohwaz/<?echo md5($row->username)?>/50" alt="" width="50" height="50" /></a></td>
									<td valign="middle"><a href="http://noisestats.radumicu.info/profile/usr/<?echo $row->username?>"><h1><?echo $row->username?> &#187;</h1></a></td>
								</tr>
						 		<?endforeach;?>
						 		</table>
						 	<?endif;?>
						</p>						
					</div>
					<p class="meta"></p>
				</div>
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>