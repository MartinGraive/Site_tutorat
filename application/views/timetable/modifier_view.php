<?php echo form_open(current_url());?>
<p>
    <label for="jour">Jour :</label>
    <select name="jour" id ="jour">
		<option value="0">Lundi</option>
		<option value="1">Mardi</option>
		<option value="2">Mercredi</option>
		<option value="3">Jeudi</option>
		<option value="4">Vendredi</option>
	</select>
    <?php echo form_error('jour'); ?>
	
	<br />

    <label for="tuteurs">Tuteurs :</label>
    <input type='name' name="tuteurs" id="tuteurs" value="<?=$cours[0]->tuteurs?>"/>
    <?php echo form_error('tuteurs'); ?>
 
    <input type="submit" value="Envoyer" />
</p>
</form>
