{*
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2017. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@cubecart.com
 * License:  GPL-3.0 https://www.gnu.org/licenses/quick-guide-gplv3.html
 *}
<form action="{$VAL_SELF}" method="post" enctype="multipart/form-data">
  <div id="countries" class="tab_content">
	<h3>{$LANG.country.title_country}</h3>
	<table>
	  <thead>
		<tr>
		  <td>&nbsp;</td>
		  <td>{$LANG.country.country_name}</td>
		  <td>{$LANG.country.country_iso_alpha2}</td>
		  <td>{$LANG.country.country_iso_alpha3}</td>
		  <td>{$LANG.country.country_iso_numeric}</td>
		  <td><abbr title="{$LANG.country.eu}">{$LANG.country.eu_short}</abbr></td>
		  <td>{$LANG.common.status}</td>
		  <td>&nbsp;</td>
		</tr>
	  </thead>
	  <tbody>
	  {foreach from=$COUNTRIES item=country}
		<tr>
		  <td><input type="checkbox" name="multi_country[{$country.id}]" name="multi_country" value="1" class="all-countries"></td>
		  <td><span class="editable" name="country[{$country.id}][name]">{$country.name}</span></td>
		  <td><span class="editable number" name="country[{$country.id}][iso]">{$country.iso}</span></td>
		  <td><span class="editable number" name="country[{$country.id}][iso3]">{$country.iso3}</span></td>
		  <td><span class="editable number" name="country[{$country.id}][numcode]">{$country.numcode}</span></td>
		  <td style="text-align:center"><input name="country[{$country.id}][eu]" id="{$country.id}_eu" type="hidden" class="toggle" value="{$country.eu}"></td>
		  <td style="text-align:center">
			<select name="country[{$country.id}][status]" id="{$country.id}_status">
				<option value="0"{if $country.status=='0'} selected="selected"{/if}>{$LANG.common.disabled}</option>
				<option value="1"{if $country.status=='1'} selected="selected"{/if}>{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.required})</option>
				<option value="2"{if $country.status=='2'} selected="selected"{/if}>{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.optional|replace:array('(',')'):''})</option>
				<option value="3"{if $country.status=='3'} selected="selected"{/if}>{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.disabled})</option>
			</select>
			</td>
		  <td style="text-align:center"><a href="{$country.delete}" class="delete" title="{$LANG.notification.confirm_delete}"><i class="fa fa-trash" title="{$LANG.common.delete}"></i></a></td>
		</tr>
	  {/foreach}
  	  <tfoot>
  	  	<tr>
  	  	  <td><img src="{$SKIN_VARS.admin_folder}/skins/{$SKIN_VARS.skin_folder}/images/select_all.gif" alt=""></td>
  	  	  <td colspan="5">
  	  	    <a href="#" class="check-all" rel="all-countries">{$LANG.form.check_uncheck}</a>
  	  	    <select name="multi_country_action">
  	  	   	  <option value="">{$LANG.form.with_selected}</option>
  	  	      <option value="delete">{$LANG.common.delete}</option>
  	  	      <option value="1">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.required})</option>
							<option value="2">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.optional|replace:array('(',')'):''})</option>
							<option value="3">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.disabled})</option>
  	  	      <option value="0">{$LANG.common.disable}</option>
  	  	    </select>
  	  	    <input type="submit" value="{$LANG.common.go}" name="go" class="tiny">
  	  	  </td>
  	  	</tr>
  	  </tfoot>
	  </tbody>
	</table>
	<div class="pagination">
	  <span><strong>{$TOTAL_RESULTS}</strong></span>
	  {$PAGINATION_COUNTRY}&nbsp;
	</div>
  </div>
  <div id="add_country" class="tab_content">
  	<h3>{$LANG.country.title_country_add}</h3>
		<fieldset>
		  <div><label for="country-name">{$LANG.country.country_name}</label><span><input type="text" name="new_country[name]" id="country-name" class="textbox required"></span></div>
		  <div><label for="country-iso">{$LANG.country.country_iso_alpha2}</label><span><input type="text" name="new_country[iso]" id="country-iso" class="textbox"></span></div>
		  <div><label for="country-iso3">{$LANG.country.country_iso_alpha3}</label><span><input type="text" name="new_country[iso3]" id="country-iso3" class="textbox"></span></div>
		  <div><label for="country-num">{$LANG.country.country_iso_numeric}</label><span><input type="text" name="new_country[numcode]" id="country-num" class="textbox"></span></div>
		  <div><label for="country-eu">{$LANG.country.assign_to_eu}</label><span><input name="new_country[eu]" id="country-eu" type="hidden" class="toggle" value="0" /></span></div>
			<div><label for="country-status">{$LANG.common.status}</label><span><select name="new_country[status]" id="country-status">
				<option value="0">{$LANG.common.disabled}</option>
				<option value="1">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.required})</option>
				<option value="2">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.optional|replace:array('(',')'):''})</option>
				<option value="3">{$LANG.common.enabled} ({$LANG.country.zone} {$LANG.common.disabled})</option>
			</select>
			</div>
		</fieldset>
	</div>

  <div id="zones" class="tab_content">
  <h3>{$LANG.country.title_zone}</h3>
	<table>
	  <thead>
		<tr>
		  <td>&nbsp;</td>
		  <td>{$LANG.address.country}</td>
		  <td width="310">{$LANG.country.zone_name}</td>
		  <td>{$LANG.country.zone_abbrev}</td>
			<td>{$LANG.common.status}</td>
		  <td>&nbsp;</td>
		</tr>
	  </thead>
	  <tbody>
	  {foreach from=$ZONES item=zone}
		<tr>
		<td><input type="checkbox" name="multi_zone[{$zone.id}]" value="1" class="all-zones"></td>
		  <td>{$zone.country}</td>
		  <td><span class="editable" name="zone[{$zone.id}][name]">{$zone.name}</span></td>
		  <td width="110"><span class="editable number" name="zone[{$zone.id}][abbrev]">{$zone.abbrev}</span></td>
		  <td style="text-align:center"><input type="hidden" name="zone[{$zone.id}][status]" id="zone_status_{$zone.id}" value="{$zone.status}" class="toggle"></td>
			<td><a href="{$zone.delete}" class="delete" title="{$LANG.notification.confirm_delete}"><i class="fa fa-trash" title="{$LANG.common.delete}"></i></a></td>
		</tr>
	  {/foreach}
	  </tbody>
	  <tfoot>
  	  	<tr>
  	  	  <td><img src="{$SKIN_VARS.admin_folder}/skins/{$SKIN_VARS.skin_folder}/images/select_all.gif" alt=""></td>
  	  	  <td colspan="5">
  	  	    <a href="#" class="check-all" rel="all-zones">{$LANG.form.check_uncheck}</a>
  	  	    <select name="multi_zone_action">
  	  	    	<option value="">{$LANG.form.with_selected}</option>
  	  	        <option value="delete">{$LANG.common.delete}</option>
  	  	    </select>
  	  	    <input type="submit" name="go" value="{$LANG.common.go}" class="tiny">
  	  	  </td>
  	  	</tr>
  	  </tfoot>
	</table>
	<div class="pagination">
	  <span><strong>{$TOTAL_RESULTS}</strong></span>
	  {$PAGINATION_ZONE}&nbsp;
	</div>
  </div>

  <div id="add_zone" class="tab_content">
  	<h3>{$LANG.country.title_zone_add}</h3>
	<fieldset>
	  <div><label for="zone-country">{$LANG.country.zone_country}</label><span>
		<select name="new_zone[country_id]" id="zone-country" class="textbox required">
		{foreach from=$SELECT_COUNTRY item=country}<option value="{$country.id}">{$country.name}</option>{/foreach}
		</select></span></div>
	  <div><label for="zone-name">{$LANG.country.zone_name}</label><span><input type="text" name="new_zone[name]" id="zone-name" class="textbox required"></span></div>
	  <div><label for="zone-abbrev">{$LANG.country.zone_abbrev}</label><span><input type="text" name="new_zone[abbrev]" id="zone-abbrev" class="textbox"></span></div>
	</fieldset>
	</div>

  {include file='templates/element.hook_form_content.php'}
  
  <div class="form_control">
	<input type="hidden" name="previous-tab" id="previous-tab">
	<input type="submit" name="save" value="{$LANG.common.save}">
  </div>
  
</form>