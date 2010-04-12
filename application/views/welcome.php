			<div id="content">
				<div class="post">
					<h2 class="title"><a href="#">Bine ati venit la Noise Stats</a></h2>
					<div class="entry"> <img src="<?=base_url()?>assets/images/template/logo1.png" alt="" class="left" />
						<p><strong>Noise Stats</strong> este o comunitate muzicala online care genereaza statistici pe baza preferintelor tale auditive.</p>
						<p>Datale sunt colectate prin descarcarea unui plugin care il folosesti impreuna cu player-ul tau preferat.</p>
						<p>In spatele scenei plugin-ul trimite informatiile referitoare la melodiile ascultate catre server, acesta le proceseaza si genereaza statistica.</p>
						<p>Tehnologina folosita este asemanatoare cu <a href="http://www.audioscrobbler.net/" target="_blank">Audioscrobbler</a> care este un produs <a href="http://www.last.fm/" target="_blank">Last.fm</a>..</p>
						<p>Pentru a beneficia de Noise Stats trebuie sa ai un cont creat pentru a putea asocia datele cu userul tau. Pagina de inregistrare este <a href="/auth/register_recaptcha/">aici</a>.</p>
					</div>
					<p class="meta"> <span class="posted">Postat de <a href="#">RaduM</a> in Ianuarie 16, 2009</span> <a href="#" class="permalink">Citeste mai mult</a> <!--<a href="#" class="comments">Comentarii (0)</a>--> </p>
				</div>
			</div>
			<!-- end #content -->
			<div id="sidebar">
				<ul>
					<li id="search">
						<h3>Cauta user:</h3>						
						<form action="<?=base_url()?>searchuser/" method="post" id="searchform">
							<div>
								<input type="text" name="searchInput" id="searchInput" size="15" />
								<br />
								<input name="submit" type="submit" value="Go" />
							</div>
						</form>
					</li>
					<li>
						<h3>noise menu</h3>						
						<?php if($this->dx_auth->is_logged_in()): ?>
						  <p>
						  	<a href="http://noisestats.radumicu.info/auth/logout/">Logout</a><br />
						  	<a href="http://noisestats.radumicu.info/profile/">Profil</a>
						  </p>
						<?php else: ?>						
						  <p><a href="/auth/login">Intra in cont</a></p>
						  <p>Inca nu ai cont?<br/> Pentru a intra in comunitatea <strong>Noise-Stats</strong> te poti inregistra printr-un click <a href="http://noisestats.radumicu.info/auth/register_recaptcha/">aici</a></p>
						<?php endif; ?>
					</li>
					<li>
						<h3>Top artisti:</h3>
						<ul>
						    <?for($i = 0; $i < count($topArtists); $i++):?>
						    <li><?echo $i+1?>. <a href="#"><?echo $topArtists[$i]?></a></li>
						    <?endfor;?>
						</ul>
					</li>
				</ul>
			</div>
			<!-- end #sidebar -->
			<div style="clear: both;">&nbsp;</div>