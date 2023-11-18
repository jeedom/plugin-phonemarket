
/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

function addCmdToTable(_cmd) {
    if (!isset(_cmd)) {
        var _cmd = { configuration: {} };
    }
    if (!isset(_cmd.type) || _cmd.type == 'action') {
        var tr = '<tr class="cmd" data-cmd_id="' + init(_cmd.id) + '">';
        tr += '<td>';
        tr += '<input class="cmdAttr form-control input-sm" data-l1key="id" style="display : none;">';
        tr += '<input class="cmdAttr form-control input-sm" data-l1key="type" value="action" style="display : none;">';
        tr += '<input class="cmdAttr form-control input-sm" data-l1key="subType" value="message" style="display : none;">';

        tr += '<div class="input-group">';
        tr += '<input class="cmdAttr form-control input-sm roundedLeft" data-l1key="name" placeholder="{{Nom de la commande}}">';
        tr += '<span class="input-group-btn"><a class="cmdAction btn btn-sm btn-default" data-l1key="chooseIcon" title="{{Choisir une icône}}"><i class="fas fa-icons"></i></a></span>';
        tr += '<span class="cmdAttr input-group-addon roundedRight" data-l1key="display" data-l2key="icon" style="font-size:19px;padding:0 5px 0 0!important;"></span>';
        tr += '</div>';
        tr += '</td>';

        tr += '<td>';
        tr += '<select class="form-control cmdAttr input-sm" data-l1key="configuration" data-l2key="type">';
        tr += '<option value="sms">{{SMS}}</option>';
        tr += '<option value="call">{{Appels}}</option>';
        tr += '</select>';
        tr += '</td>';

        tr += '<td><input class="cmdAttr form-control input-sm" data-l1key="configuration" data-l2key="phonenumber"></td>';

        tr += '<td>';
        tr += '<label class="checkbox-inline"><input type="checkbox" class="cmdAttr" data-l1key="isVisible" checked/>{{Afficher}}</label> ';
        tr += '</td>';

        tr += '<td>';
        if (is_numeric(_cmd.id)) {
            tr += '<a class="btn btn-default btn-xs cmdAction" data-action="configure"><i class="fas fa-cogs"></i></a> '
            tr += '<a class="btn btn-default btn-xs cmdAction" data-action="test"><i class="fas fa-rss"></i> {{Tester}}</a>'
        }
        tr += '<i class="fas fa-minus-circle pull-right cmdAction cursor" data-action="remove" title="{{Supprimer la commande}}"></i></td>'

        tr += '</tr>';

        $('#table_cmd tbody').append(tr);
        $('#table_cmd tbody tr').last().setValues(_cmd, '.cmdAttr');
    }
}