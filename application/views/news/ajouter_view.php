<h3>Ajout de news</h3>

<?php echo form_open(current_url());?>
<p>
    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" value="<?php echo set_value('titre'); ?>" />
    <?php echo form_error('titre'); ?>
	
	<br />

    <label for="contenu">Contenu :</label>
    <textarea name="contenu" id="contenu" value="<?php echo set_value('contenu'); ?>" ></textarea>
    <?php echo form_error('contenu'); ?>
 
	<input type="hidden" name="action" value="ajout" />
    <input type="submit" value="Envoyer" />
</p>
</form>
