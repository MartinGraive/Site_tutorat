<h2>Test</h2>
<ul>
<?php
foreach($news as $news_i):?>

<li><?=$news_i->titre?> (Publié le <?=$news_i->date?>)
<p><?=$news_i->contenu?> 

<?php if($admin): ?><a href="<?=site_url('news/modifier/'.$news_i->id)?>">Modifier</a><br />
<a href="javascript:void" class="suppression" id="<?=$news_i->id?>">Supprimer news</a>
<?php endif; ?>

<br /><br /></p></li>

<?php endforeach;?>
</ul>


<script>
	function envoyerRequete(id, confirm) 
	{
		if (confirm)		
		{		
			var xhr = new XMLHttpRequest();
        	xhr.open('POST', '<?=site_url("news/supprimer")?>');
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        	xhr.send('id='+id);
			document.location.reload(true)
		}

     }

		(function()
		{ 
			var liensSuppression = document.getElementsByClassName('suppression'),
              	liensSuppressionLen = liensSuppression.length;
        
			for (var i = 0 ; i < liensSuppressionLen ; i++)
			{
				liensSuppression[i].onclick = function()
				{
					envoyerRequete(this.id, confirm('Êtes-vous sur de vouloir supprimer cette news ?'));
				};
			}

      	})();

    </script>


<?php
/* End of file news_view.php */
/* Location: ./application/views/news_view.php */
?>
