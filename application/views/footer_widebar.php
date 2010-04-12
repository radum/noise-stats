			<div id="widebar">
				<div id="colA">
					<h3>Ultimele noutati</h3>
					<dl class="list1">
						<dt>22.06.2009</dt>
						<dd><a href="#">Versiunea 0.9 este online</a></dd>
						<dt>18.01.2009</dt>
						<dd><a href="#">Versiunea 0.2 este online</a></dd>
						<dt>17.01.2009</dt>
						<dd><a href="#">Versiunea 0.1 este online</a></dd>					
						<dt>16.01.2009</dt>
						<dd><a href="#">Versiunea 0.0 este online</a> :)</dd>
					</dl>
				</div>
				<div id="colB">
					<h3>Ajutor</h3>
					<dl class="list1">
						<dd>&#187; <a href="#">F.A.Q.</a></dd>
						<dd>&#187; <a href="#">Suport site</a></dd>
						<dd>&#187; <a href="/contact/">Contact</a></dd>
					</dl>					
				</div>
				<div id="colC">
					<h3>Utilizatori:</h3>
					<ul class="list2">
					<?$i = 0;?>
					<?foreach($usersListArr->result() as $row):?>
						<?$i++;?>
					 	<li<?if($i%3==0){echo ' class="nopad"';}?>><a href="http://noisestats.radumicu.info/profile/usr/<?echo $row->username?>"><img src="http://friedcellcollective.net/monsterid/bohwaz/<?echo md5($row->username)?>/50" alt="" width="50" height="50" /></a></li>
				 	<?endforeach;?>
					</ul>
				</div>
				<div style="clear: both;">&nbsp;</div>
			</div>
			<!-- end #widebar -->
		</div>
		<!-- end #page -->
	</div>
	<!-- end #wrapper2 -->