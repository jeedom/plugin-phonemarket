<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('phonemarket');
sendVarToJS('eqType', 'phonemarket');
$eqLogics = eqLogic::byType('phonemarket');
?>

<div class="row row-overflow">
   <div class="col-lg-12 eqLogicThumbnailDisplay>
    <legend><i class="fas fa-cog"></i>  {{Gestion}}</legend>
    <div class="eqLogicThumbnailContainer">
      <div class="cursor eqLogicAction" data-action="add" s>
        <i class="fa fa-plus-circle"></i>
    <br>
    <span>{{Ajouter}}</span>
</div>
	</div>																	 
<legend><i class="fas fa-phone"></i>  {{Mes Equipements PhoneMarket}}</legend>		
<div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay><legend><i class="fa fa-phone"></i>  {{Mes Equipements PhoneMarket}}</legend>
<?php
foreach ($eqLogics as $eqLogic) {
	$opacity = ($eqLogic->getIsEnable()) ? '' : jeedom::getConfiguration('eqLogic:style:noactive');
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" >';
	echo '<img src="' . $plugin->getPathImgIcon() . '" height="105" width="95" />';
	echo "<br>";
	echo '<span>' . $eqLogic->getHumanName(true, true) . '</span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-12 eqLogic">
    <a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
    <a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>

    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tachometer"></i> {{Equipement}}</a></li>
      <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Commandes}}</a></li>
  </ul>

  <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
      <div role="tabpanel" class="tab-pane active" id="eqlogictab">
        <form class="form-horizontal">
            <fieldset>
                <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{Nom de l'équipement phonemarket}}</label>
                    <div class="col-sm-3">
                        <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
                        <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement template}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >{{Objet parent}}</label>
                    <div class="col-sm-3">
                        <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                            <option value="">{{Aucun}}</option>
                            <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
                       </select>
                   </div>
               </div>
               <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                    <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
                    <label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">{{Catégorie}}</label>
                <div class="col-sm-8">
                    <?php
foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
	echo '<label class="checkbox-inline">';
	echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
	echo '</label>';
}
?>
               </div>
           </div>
       </fieldset>
   </form>

</div>
<div role="tabpanel" class="tab-pane" id="commandtab">
    <div class="alert alert-info">{{Un SMS vaut un crédit, un appel vaut 2 crédits. Attention les SMS sont tronqué à 140 caractères et les appels à 450 caractères. Vous pouvez voir vos crédits restants <a target="_blank" href="http://market.jeedom.fr/index.php?v=d&p=profils&tab=sms">ici</a>}}</div>
    <a class="btn btn-success btn-sm cmdAction pull-right" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter une commande}}</a><br/><br/>
    <table id="table_cmd" class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>{{Nom}}</th>
                <th>{{Type}}</th>
                <th>{{Numéro}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>
</div>

</div>
</div>

<?php include_file('desktop', 'phonemarket', 'js', 'phonemarket');?>
<?php include_file('core', 'plugin.template', 'js');?>
