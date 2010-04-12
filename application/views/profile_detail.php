<?
function lastFMArtistImg($artist)
{
  $xml = simplexml_load_file('http://ws.audioscrobbler.com/2.0/?method=artist.getimages&artist='.urlencode($artist).'&limit=1&api_key=617a87a0e61087dc75d2a9fee2984ca5');
  foreach($xml->xpath("//size[@name='original']") as $artistImg)
  {echo $artistImg;}
}

function lastFMArtistAlbum($artist, $album)
{
  $xml = simplexml_load_file('http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=617a87a0e61087dc75d2a9fee2984ca5&artist='.urlencode($artist).'&album='.urlencode($album));  
  foreach($xml->xpath("//image[@size='extralarge']") as $artistImg)
  {echo $artistImg;}
}

if($hasData == true){
include ('OFC/php-ofc-library/open-flash-chart.php');
//Defaults
$toolTip = '#val# of #total#<br>#percent# of 100%';
$toolTipLabel = '#label#<br>#val# of #total#<br>#percent# of 100%';

//Pie 1
$title1 = new title( "Top Artisti" );$pie1 = new pie();$pie1->set_alpha(0.6);$pie1->add_animation( new pie_bounce(8) );$pie1->radius(100);
$pie1->add_animation( new pie_fade() );$pie1->set_tooltip( $toolTip );$pie1->set_colours( array('#D544A2','#9408E0','#E25374','#269C16','#9F0946','#EC7E64','#8F4F64','#0AD5A5','#F957BD','#F4C377','#0CEBC5','#CCDE8B','#F7FB8C','#7CBF0C','#799756','#D5FFA2') );
//Pie 2
$title2 = new title( "Top Melodii" );$pie2 = new pie();$pie2->set_alpha(0.6);$pie2->add_animation( new pie_bounce(8) );//$pie2->radius(100);
$pie2->add_animation( new pie_fade() );$pie2->set_tooltip( $toolTip );$pie2->set_colours( array('#D544A2','#9408E0','#E25374','#269C16','#9F0946','#EC7E64','#8F4F64','#0AD5A5','#F957BD','#F4C377','#0CEBC5','#CCDE8B','#F7FB8C','#7CBF0C','#799756','#D5FFA2') );
//Pie 3
$title3 = new title( "Top Albume" );$pie3 = new pie();$pie3->set_alpha(0.6);$pie3->add_animation( new pie_bounce(8) );//$pie3->radius(100);
$pie3->add_animation( new pie_fade() );$pie3->set_tooltip( $toolTipLabel );$pie3->set_colours( array('#D544A2','#9408E0','#E25374','#269C16','#9F0946','#EC7E64','#8F4F64','#0AD5A5','#F957BD','#F4C377','#0CEBC5','#CCDE8B','#F7FB8C','#7CBF0C','#799756','#D5FFA2') );
$pie3->set_no_labels();
//Pie 1
foreach($topArtistArr->result() as $row)
{$pieArr1[] = new pie_value(intval($row->artistCount), $row->artist);}
//Pie 2
foreach($topSongsArr->result() as $row)
{$pieArr2[] = new pie_value(intval($row->trackIdCount), $row->trackName);}
//Pie 3
foreach($topAlbumsArr->result() as $row)
{$pieArr3[] = new pie_value(intval($row->trackIdCount), $row->album);}

$pie1->set_values( $pieArr1 );//Pie 1
$pie2->set_values( $pieArr2 );//Pie 2
$pie3->set_values( $pieArr3 );//Pie 3

//Pie 1
$chart1 = new open_flash_chart();$chart1->set_bg_colour('#EEEEEE');$chart1->set_title( $title1 );
$chart1->add_element( $pie1 );$chart1->x_axis = null;

//Pie 2
$chart2 = new open_flash_chart();$chart2->set_bg_colour('#EEEEEE');$chart2->set_title( $title2 );
$chart2->add_element( $pie2 );$chart2->x_axis = null;

//Pie 3
$chart3 = new open_flash_chart();$chart3->set_bg_colour('#EEEEEE');$chart3->set_title( $title3 );
$chart3->add_element( $pie3 );$chart3->x_axis = null;
}?>
<?if($hasData == true):?>
<script type="text/javascript" src="http://noisestats.radumicu.info/OFC/js/json/json2.js"></script>
<script type="text/javascript" src="http://noisestats.radumicu.info/OFC/js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("http://noisestats.radumicu.info/OFC/open-flash-chart.swf", "my_chart_1", "400", "300", "9.0.0", "expressInstall.swf", {"get-data":"get_data_1"},{"wmode":"transparent"});
swfobject.embedSWF("http://noisestats.radumicu.info/OFC/open-flash-chart.swf", "my_chart_2", "400", "300", "9.0.0", "expressInstall.swf", {"get-data":"get_data_2"},{"wmode":"transparent"});
swfobject.embedSWF("http://noisestats.radumicu.info/OFC/open-flash-chart.swf", "my_chart_3", "360", "300", "9.0.0", "expressInstall.swf", {"get-data":"get_data_3"},{"wmode":"transparent"});
function ofc_ready() {/*alert('ofc_ready');*/}
function get_data_1(){return JSON.stringify(data_1);}
function get_data_2(){return JSON.stringify(data_2);}
function get_data_3(){return JSON.stringify(data_3);}
function findSWF(movieName) { if (navigator.appName.indexOf("Microsoft")!= -1) { return window[movieName]; } else { return document[movieName]; } }
var data_1 = <?php echo $chart1->toPrettyString(); ?>;
var data_2 = <?php echo $chart2->toPrettyString(); ?>;
var data_3 = <?php echo $chart3->toPrettyString(); ?>;
</script>
<?endif;?>
			<div id="content-full">
				<div class="post">
					<h2 class="title"><a href="#"><img src="http://friedcellcollective.net/monsterid/bohwaz/<?echo md5($userName)?>/25" alt="" width="25" height="25" /> Noise Stats / <?echo $userName?></a></h2>
					<div class="entry"><img src="<?=base_url()?>assets/images/template/kchart.png" alt="" class="right" />
					<?if($hasData == false):?>
						<p>Userul <strong><?echo $userName?></strong> nu are inca nimic salvat in baza...</p>					
					<?else:?>
					<p>In statistica generala pentru <strong><?echo $userName?></strong> regasim:</p>					
					<p>
					<img src="<?=base_url()?>assets/images/site/artists.png" alt="" border="0"/> <?echo $noOfUserArtists;?> artisti<br/>
					<img src="<?=base_url()?>assets/images/site/tracks.png" alt="" border="0"/> <?echo $noOfUserTracks;?> melodii<br/>
					<img src="<?=base_url()?>assets/images/site/albums.png" alt="" border="0"/> <?echo $noOfUserAlbums;?> albume<br/>
					<span><img src="<?=base_url()?>assets/images/site/bars.gif" alt="" border="0"/> Ultima piesa ascultata <b><?echo $lastScrobbledTrack->row()->trackName;?> - <?echo $lastScrobbledTrack->row()->artist;?></b> a fost in data de <b><?echo $lastScrobbledTrack->row()->lastScrobbledTime;?></b>
					</p>
					<?endif;?>
					</div>
					<p class="meta"></p>
					<?if($hasData == true):?>
					<div class="entry">
						<p>
							<div id="tabs">
								<ul>
									<li><a href="#tabs-1">Top Artisti</a></li>
									<li><a href="#tabs-2">Top Melodii</a></li>
									<li><a href="#tabs-3">Top Albume</a></li>
								</ul>								
								<div id="tabs-1">
									<table width="100%"><tr><td width="100%">
									<p>Topul celor mai ascultati artisti</p>									
									<p>
										<ol id="olArtist">
						    			<?foreach($topArtistArr->result() as $row):?>
					    					<li><a href="<?lastFMArtistImg($row->artist);?>"><?echo $row->artist?></a> [<?echo $row->artistCount?>]</li>
						    			<?endforeach;?>
										</ol>										
									</p>
									</td><td>
									<div id="my_chart_1"></div>
									</td></tr></table>
								</div>
								<div id="tabs-2">
									<table width="100%"><tr><td width="100%">
									<p>Topul celor mai ascultate melodii</p>
									<p>
										<ol>
										 <?foreach($topSongsArr->result() as $row):?>
										 	<li><a href="#"><?echo $row->trackName?></a> - <?echo $row->artist?> [<?echo $row->trackIdCount?>]</li>
										 <?endforeach;?>
										</ol>
									</p>
									</td><td>
									<div id="my_chart_2"></div>
									</td></tr></table>
								</div>
								<div id="tabs-3">
									<table width="100%"><tr><td width="100%">
									<p>Topul celor mai ascultate albume</p>
									<p>
										<ol id="olAlbum">
										 <?foreach($topAlbumsArr->result() as $row):?>
										 	<li><a href="<?lastFMArtistAlbum($row->artist, $row->album);?>"><?echo $row->album?></a> - <?echo $row->artist?> [<?echo $row->trackIdCount?>]</li>
										 <?endforeach;?>
										</ol>
									</p>
									</td><td>
									<div id="my_chart_3"></div>
									</td></tr></table>
								</div>
							</div>
							<script type="text/javascript">							
								$(function() {
									$("#tabs").tabs({
										collapsible: true									
									});
								});								
								
								$(document).ready(function() {
									$('ol#olArtist a').imgPreview({
										containerID: 'imgPreviewWithStyles',
										imgCSS: {
											// Limit preview size:
											height: 250
										},
										// When container is shown:
										onShow: function(link){
											$('<span>' + $(link).text() + '</span>').appendTo(this);
											},
										// When container hides:
										onHide: function(link){
											$('span', this).remove();
										}
									});
									
									$('ol#olAlbum a').imgPreview({
										containerID: 'imgPreviewWithStyles',
										imgCSS: {
											// Limit preview size:
											height: 250
										},
										// When container is shown:
										onShow: function(link){
											$('<span>' + $(link).text() + '</span>').appendTo(this);
											},
										// When container hides:
										onHide: function(link){
											$('span', this).remove();
										}
									});
								});
							</script>

						</p>
					</div>					
					<p class="meta"></p>
					<?endif;?>
				</div>
			</div>
			<!-- end #content -->
			<div style="clear: both;">&nbsp;</div>