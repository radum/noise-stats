			<div id="content-full">
				<div class="post">
					<h2 class="title"><a href="#">Contact</a></h2>
					<div class="entry"> <img src="<?=base_url()?>assets/images/template/contact_logo.png" alt="" class="right" />
						<?if($contactStatus == true):?>
						<p>Multumim pentru mesaj. In cel mai scurt timp vom revenii cu un raspuns.</p>
						<p>&nbsp;</p><p>&nbsp;</p>
						<?else:?>
						<p>
						<?php echo form_open('contact'); ?>
						 Nume / Prenume<br />
						  <input type="text" name="name" /><br /><br />
						 Email<br />
						  <input type="text" name="email" /><br /><br />
						 Subiect<br />
						  <input type="text" name="subject" /><br /><br />
						 Mesajul catre noi<br />
						  <textarea rows="10" cols="60" name="message"></textarea><br />
						<input type="submit" name="submit" value="Trimite mesaj" />   						
  						</form>
						</p>
						<?endif;?>						
					</div>
					<p class="meta"></p>
				</div>				
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>