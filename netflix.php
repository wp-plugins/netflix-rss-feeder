<?php

/*
Plugin Name: Netflix RSS Feeder
Plugin URI: http://www.leviathanc.com/netflix-rss-feeder/
Plugin Version: 1.0
Description: This plugin displays RSS Feed from your Netflix account.  
A Netflix account is required. Go to 
<a href="wp-admin/options-general.php?page=netflix/netflix.php">Netflix Option</a>.
Author: Levi Coplen
Author URI: http://www.leviathanc.com
License: GPL

    Netflix RSS Feeder - Display Netflix RSS from account on WordPress Blog
    Copyright (C) 2007, 2008 Levi Coplen

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Version 1.0 - Initial Release
*/

function shownetflix_admin_menu()
{
	add_options_page('Netflix Options', 'Netflix', 8, __FILE__, 'shownetflix_admin');
}

add_action('admin_menu', 'shownetflix_admin_menu');

function widget_netflix()
{
	netflix();
}

function widget_netflix_init()
{
	$widget_ops = array('class' => 'widget_netflix', 'description' => __( "Netflix RSS Feeder" ) );
	wp_register_sidebar_widget('netflix', __('Netflix'), 'widget_netflix', $widget_ops);
}

add_action('init', 'widget_netflix_init');

function shownetflix_admin()
{
	if($_POST["netflix_action"])
	{
		update_option('netflix_rss', $_POST['netflix_rss']);
		update_option('netflix_moviesathome', $_POST['netflix_moviesathome']);
		update_option('netflix_queue', $_POST['netflix_queue']);
		update_option('netflix_notifications', $_POST['netflix_notifications']);
		update_option('netflix_recommendations', $_POST['netflix_recommendations']);
		update_option('netflix_reviews', $_POST['netflix_reviews']);
		update_option('netflix_instant', $_POST['netflix_instant']);
		update_option('netflix_moviesathome_number', $_POST['netflix_moviesathome_number']);
		update_option('netflix_queue_number', $_POST['netflix_queue_number']);
		update_option('netflix_notifications_number', $_POST['netflix_notifications_number']);
		update_option('netflix_recommendations_number', $_POST['netflix_recommendations_number']);
		update_option('netflix_reviews_number', $_POST['netflix_reviews_number']);
		update_option('netflix_instant_number', $_POST['netflix_instant_number']);
		update_option('moviesathome_desc', $_POST['moviesathome_desc']);
		update_option('queue_desc', $_POST['queue_desc']);
		update_option('notifications_desc', $_POST['notifications_desc']);
		update_option('recommendations_desc', $_POST['recommendations_desc']);
		update_option('reviews_desc', $_POST['reviews_desc']);
		update_option('instant_desc', $_POST['instant_desc']);

		$strMessage = "<div id='message' class='updated fade'><p>Netflix RSS Options successfully updated.</p></div><br/>";
	}

	$wp_netflix_rss = get_option('netflix_rss');
	$wp_netflix_moviesathome = get_option('netflix_moviesathome');
	$wp_netflix_queue = get_option('netflix_queue');
	$wp_netflix_notifications = get_option('netflix_notifications');
	$wp_netflix_recommendations = get_option('netflix_recommendations');
	$wp_netflix_reviews = get_option('netflix_reviews');
	$wp_netflix_instant = get_option('netflix_instant');
	$wp_moviesathome_number = get_option('netflix_moviesathome_number');
	$wp_queue_number = get_option('netflix_queue_number');
	$wp_notifications_number = get_option('netflix_notifications_number');
	$wp_recommendations_number = get_option('netflix_recommendations_number');
	$wp_reviews_number = get_option('netflix_reviews_number');
	$wp_instant_number = get_option('netflix_instant_number');
	$wp_moviesathome_desc = get_option('moviesathome_desc');
	$wp_queue_desc = get_option('queue_desc');
	$wp_notifications_desc = get_option('notifications_desc');
	$wp_recommendations_desc = get_option('recommendations_desc');
	$wp_reviews_desc = get_option('reviews_desc');
	$wp_instant_desc = get_option('instant_desc');
?>

	<div class="wrap">
		<h2>Netflix RSS Feeder</h2>

		<p>
			<?php if ($strMessage <> "") { print $strMessage; } ?>
		</p> 

		<fieldset class="options">
			<legend>Netflix Options</legend>
			<form method="post" action="">
				<p>Add your Netflix RSS Feeder ID -> 
				<input name="netflix_rss" type="text" id="netflix_rss" value="<?php echo get_option('netflix_rss'); ?>" maxlength="40" size="50" />
				View your <a href="http://www.netflix.com/RSSFeeds">Netflix RSS Feeds</a> to find your Netflix ID.
				<hr>

				<table width="100%" cellspacing="2" cellpadding="5" class="editform">

					<tr valign="top">
						<th width="33%" scope="row">Movies At Home:</th> 
						<td>
							<input type="checkbox" id="netflix_moviesathome" name="netflix_moviesathome" value="netflix_moviesathome" <?php if($wp_netflix_moviesathome == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_moviesathome_number" name="netflix_moviesathome_number">
								<?php
									for ($i=1; $i <= 10; $i++)
									{
										echo "<option ";

										if(get_option('netflix_moviesathome_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_moviesathome_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="moviesathome_desc" name="moviesathome_desc">
								<option <?php if(get_option('moviesathome_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('moviesathome_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td> 
					</tr>

					<tr valign="top"> 
						<th width="33%" scope="row">Queue:</th> 
						<td>
							<input type="checkbox" id="netflix_queue" name="netflix_queue" value="netflix_queue" <?php if($wp_netflix_queue == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_queue_number" name="netflix_queue_number">
								<?php
									for ($i=1; $i <= 50; $i++)
									{
										echo "<option ";

										if(get_option('netflix_queue_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_queue_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="queue_desc" name="queue_desc">
								<option <?php if(get_option('queue_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('queue_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td>
					</tr>

					<tr valign="top">
						<th width="33%" scope="row">Ship/Receieve Notifications:</th> 
						<td>
							<input type="checkbox" id="netflix_notifications" name="netflix_notifications" value="netflix_notifications" <?php if($wp_netflix_notifications == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_notifications_number" name="netflix_notifications_number">
								<?php
									for ($i=1; $i <= 10; $i++)
									{
										echo "<option ";

										if(get_option('netflix_notifications_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_notifications_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="notifications_desc" name="notifications_desc">
								<option <?php if(get_option('notifications_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('notifications_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td> 
					</tr>

					<tr valign="top"> 
						<th width="33%" scope="row">Recommendations:</th> 
						<td>
							<input type="checkbox" id="netflix_recommendations" name="netflix_recommendations" value="netflix_recommendations" <?php if($wp_netflix_recommendations == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_recommendations_number" name="netflix_recommendations_number">
								<?php
									for ($i=1; $i <= 10; $i++)
									{
										echo "<option ";

										if(get_option('netflix_recommendations_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_recommendations_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="recommendations_desc" name="recommendations_desc">
								<option <?php if(get_option('recommendations_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('recommendations_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td> 
					</tr>

					<tr valign="top"> 
						<th width="33%" scope="row">Customer Reviews:</th> 
						<td>
							<input type="checkbox" id="netflix_reviews" name="netflix_reviews" value="netflix_reviews" <?php if($wp_netflix_reviews == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_reviews_number" name="netflix_reviews_number">
								<?php
									for ($i=1; $i <= 10; $i++)
									{
										echo "<option ";

										if(get_option('netflix_reviews_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_reviews_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="reviews_desc" name="reviews_desc">
								<option <?php if(get_option('reviews_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('reviews_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td>
					</tr>

					<tr valign="top"> 
						<th width="33%" scope="row">Watch Instantly Queue:</th> 
						<td>
							<input type="checkbox" id="netflix_instant" name="netflix_instant" value="netflix_instant" <?php if($wp_netflix_instant == true) { echo('checked="checked"'); } ?> />
							Check to add

							<select id="netflix_instant_number" name="netflix_instant_number">
								<?php
									for ($i=1; $i <= 10; $i++)
									{
										echo "<option ";

										if(get_option('netflix_instant_number') == $i)
											echo "selected ";

										echo "value=\"$i\">" . $i . "</option>";
									}
								?>
							</select>
							<?php
								if(get_option('netflix_instant_number') > 1)
									echo "Movies";
								else
									echo "Movie";
							?>
							<select id="instant_desc" name="instant_desc">
								<option <?php if(get_option('instant_desc') == 'desc') { echo "selected"; } ?> value="desc">with description</option>
								<option <?php if(get_option('instant_desc') == 'nodesc') { echo "selected"; } ?> value="nodesc">without description</option>
							</select>
						</td>
					</tr>
				</table>

				<p class="submit">
					<input type="submit" name="netflix_action" value="Update Options" /> 
				</p>
			</form>
		</fieldset>
	</div>

<?php 
}

require_once(ABSPATH.'wp-includes/rss-functions.php');

$wp_netflix_rss = get_option('netflix_rss');

$murl = "http://rss.netflix.com/AtHomeRSS?id=$wp_netflix_rss";

function netflixmoviesathome($limit)
{
	global $murl;

	if ( $murl )
	{
		$rss = fetch_rss( $murl );
		echo wptexturize("<h2>Netflix Movies At Home</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
				break;

			$href = $item['link'];
			echo wptexturize("<li><a href=\"$href\">".$item['title']."</a></li>");

			if(get_option('moviesathome_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

$qurl = "http://rss.netflix.com/QueueRSS?id=$wp_netflix_rss";

function netflixqueue($limit)
{
	global $qurl;

	if ( $qurl )
	{
		$rss = fetch_rss( $qurl );
		echo wptexturize("<h2>Netflix Queue</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
	  			break;

			$href = $item['link'];
			echo wptexturize("<li><a href=\"$href\">".$item['title']."</a></li>");

			if(get_option('queue_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

$turl = "http://rss.netflix.com/TrackingRSS?id=$wp_netflix_rss";

function netflixtrack($limit)
{
	global $turl;

	if ( $turl )
	{
		$rss = fetch_rss( $turl );
		echo wptexturize("<h2>Netflix Tracking</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
				break;

			$href = $item['link'];
			echo wptexturize("<li><a href=\"$href\">".$item['title']."</a></li>");

			if(get_option('notifications_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

$rurl = "http://rss.netflix.com/RecommendationsRSS?id=$wp_netflix_rss";

function netflixrecommendations($limit)
{
	global $rurl;

	if ( $rurl )
	{
		$rss = fetch_rss( $rurl );
		echo wptexturize("<h2>Netflix Recommendations</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
				break;

			$href = $item['link'];
			echo wptexturize("<li><a href=\"$href\">".$item['title']."</a></li>");

			if(get_option('recommendations_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

$surl = "http://rss.netflix.com/ReviewsRSS?id=$wp_netflix_rss";

function netflixreviews($limit)
{
	global $surl;

	if ( $surl )
	{
		$rss = fetch_rss( $surl );
		echo wptexturize("<h2>Netflix Reviews</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
				break;

/*			$href = $item['link']; */
			echo wptexturize("<li><b>".$item['title']."</b><br/>");
			echo wptexturize("".$item['description']."</li>");

			if(get_option('reviews_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

$iurl = "http://rss.netflix.com/QueueEDRSS?id=$wp_netflix_rss";

function netflixinstant($limit)
{
	global $iurl;

	if ( $iurl )
	{
		$rss = fetch_rss( $iurl );
		echo wptexturize("<h2>Netflix Instantly Queue</h2><ul>");

		foreach ($rss->items as $item)
		{
			if ($limit == 0)
				break;

			$href = $item['link'];
			echo wptexturize("<li><a href=\"$href\">".$item['title']."</a></li>");

			if(get_option('instant_desc') == 'desc')
				echo wptexturize("".$item['description']."</li>");

			$limit--;
		}

		echo wptexturize("</ul>");
	}
}

function netflix()
{
	$wp_moviesathome_number = get_option('netflix_moviesathome_number');
	$wp_queue_number = get_option('netflix_queue_number');
	$wp_notifications_number = get_option('netflix_notifications_number');
	$wp_recommendations_number = get_option('netflix_recommendations_number');
	$wp_reviews_number = get_option('netflix_reviews_number');
	$wp_instant_number = get_option('netflix_instant_number');

	$wp_netflix_moviesathome = get_option('netflix_moviesathome');
	$wp_netflix_queue = get_option('netflix_queue');
	$wp_netflix_notifications = get_option('netflix_notifications');
	$wp_netflix_recommendations = get_option('netflix_recommendations');
	$wp_netflix_reviews = get_option('netflix_reviews');
	$wp_netflix_instant = get_option('netflix_instant');

	$pos = strpos(strtolower(getenv("REQUEST_URI")), '?preview=true');

	if ($pos === false)
	{
		if ($wp_netflix_moviesathome == true)		netflixmoviesathome($wp_moviesathome_number);
		if ($wp_netflix_queue == true)			netflixqueue($wp_queue_number);
		if ($wp_netflix_notifications == true)		netflixtrack($wp_notifications_number);
		if ($wp_netflix_recommendations == true)	netflixrecommendations($wp_recommendations_number);
		if ($wp_netflix_reviews == true)		netflixreviews($wp_reviews_number);
		if ($wp_netflix_instant == true)		netflixinstant($wp_instant_number);
	}
}
?>
