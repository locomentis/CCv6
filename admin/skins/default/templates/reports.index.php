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
<form action="{$VAL_SELF}" class="ignore-dirty" method="post">
  <div id="results" class="tab_content">
	<h3>{$REPORT_TITLE}</h3>
	<table>
	  <thead>
		<tr>
		  <td>{$LANG.orders.order_number}</td>
		  <td>{$LANG.basket.total_sub}</td>
		  <td>{$LANG.common.discount}</td>
		  <td>{$LANG.basket.shipping}</td>
		  <td>{$LANG.common.tax}</td>
		  <td>{$LANG.common.total}</td>
		  <td>{$LANG.common.name}</td>
		  <td>{$LANG.address.country}</td>
		  <td>{$LANG.address.state}</td>
		  <td>{$LANG.common.status}</td>
		  <td>{$LANG.common.date_time}</td>
		</tr>
	  </thead>
	  <tbody>
		{foreach from=$REPORT_DATE item=data}
		<tr>{$data.value}
		  <td nowrap="nowrap"><a href="?_g=orders&action=edit&order_id={$data.cart_order_id}" title="{$LANG.common.edit}">{$data.{$CONFIG.oid_col}|default:$data.order_id}</a></td>
		  <td style="text-align:right">{$data.subtotal}</td>
		  <td style="text-align:right">{$data.discount}</td>
		  <td style="text-align:right">{$data.shipping}</td>
		  <td style="text-align:right">{$data.total_tax}</td>
		  <td style="text-align:right">{$data.total}</td>
		  <td style="text-align:left"><a href="?_g=customers&action=edit&customer_id={$data.customer_id}">{$data.first_name|capitalize} {$data.last_name|capitalize}</a></td>
		  <td>{$data.country}</td>
		  <td>{$data.state}</td>
		  <td>{$data.status}</td>
		  <td style="text-align:center">{$data.date}</td>
		</tr>
		{foreachelse}
		<tr><td colspan="11" align="center"><strong>{$LANG.common.error_no_results}</strong></td></tr>
		{/foreach}
	  </tbody>
	  <tfoot>
		<tr class="foot" style="font-weight: bold;">
		  <td style="text-align:right">{$TALLY.orders} {if $TALLY.orders==1}{$LANG.customer.order_count_single}{else}{$LANG.customer.order_count}{/if}</td>
		  <td style="text-align:right">{$TALLY.subtotal}</td>
		  <td style="text-align:right">{$TALLY.discount}</td>
		  <td style="text-align:right">{$TALLY.shipping}</td>
		  <td style="text-align:right">{$TALLY.total_tax}</td>
		  <td style="text-align:right">{$TALLY.total}</td>
		  <td style="text-align:center" colspan="6">&nbsp;</td>
		</tr>
	  </tfoot>
	</table>
	<div>{$PAGINATION}</div>
  	<p>
		{if $DOWNLOAD}<input type="submit" name="download" class="submit" value="{$LANG.common.export}">{/if}
		{foreach from=$EXPORT item=module}
		<input type="submit" name="external_report[{$module.folder}]" class="submit" value="{$LANG.customer.export_to} {$module.description}">
		{/foreach}
  	</p>
  </div>

  <div id="search" class="tab_content">
	<h3>{$LANG.search.title_filter}</h3>
	<fieldset>
		<div>
		  <label for="date_range_from">{$LANG.search.date_range}</label>
		  <span>
			<input type="text" id="date_range_from" name="report[date][from]" class="textbox number date" value="{$POST.date.from}"> -
			<input type="text" id="date_range_to" name="report[date][to]" class="textbox number date" value="{$POST.date.to}">
		  </span>
		</div>
		<div>
			<label for="report_status">{$LANG.orders.title_order_status}</label>
			<span>
				<select id="report_status" multiple="multiple" name="report[status][]">
					{foreach from=$STATUS item=status}
					<option value="{$status.value}" {$status.selected}>{$status.name}</option>
					{/foreach}
				</select>
			</span>
		</div>
	</fieldset>
	<div><input type="submit" class="button" value="{$LANG.common.display}"></div>
  </div>
  {if isset($PLUGIN_TABS)}
      {foreach from=$PLUGIN_TABS item=tab}
		{$tab}
      {/foreach}
   {/if}   
   {include file='templates/element.hook_form_content.php'}
</form>