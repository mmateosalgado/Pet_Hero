
<nav>
	<?php if($_SESSION['type'] == "guardian"){ ?>
	<a href="<?php echo FRONT_ROOT."Guardian\showGuardianLobby";?>";>Lobby</a>
	<a href="<?php echo FRONT_ROOT."Guardian\showGuardianProfile";?>">Perfil</a>
	<?php }elseif ($_SESSION['type'] == "owner"){ ?>
	<a href="<?php echo FRONT_ROOT."Owner\showOwnerLobby";?>">Lobby</a>
	<a href="<?php echo FRONT_ROOT."Owner\showOwnerProfile";?>">Perfil</a>
	<?php }?>
	<a href="<?php echo FRONT_ROOT."Home\Logout";?>">Logout</a>
	<div class="animation start-home"></div>
</nav>

